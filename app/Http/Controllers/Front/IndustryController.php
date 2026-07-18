<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\Concerns\LoadsPageSections;
use App\Models\Industry;

class IndustryController extends Controller
{
    use LoadsPageSections;

    private $prefix = 'front.';
    private $folder = 'industries.';

    public function index()
    {
        $industries = Industry::active()
            ->ordered()
            ->latest('id')
            ->get();

        [$page, $sectionContents] = $this->loadPageSections('industries');

        return view($this->prefix . $this->folder . 'index', compact('industries', 'page', 'sectionContents'));
    }

    public function details($slug)
    {
        $industry = Industry::active()
            ->where('slug', $slug)
            ->first();

        if (! $industry) {
            abort(404);
        }

        $industry->increment('views');

        $related = Industry::active()
            ->where('id', '!=', $industry->id)
            ->ordered()
            ->latest('id')
            ->take(4)
            ->get();

        return view($this->prefix . $this->folder . 'details', compact('industry', 'related'));
    }
}
