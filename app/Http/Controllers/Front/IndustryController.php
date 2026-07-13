<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Industry;

class IndustryController extends Controller
{
    private $prefix = 'front.';
    private $folder = 'industries.';

    public function index()
    {
        $industries = Industry::active()
            ->ordered()
            ->latest('id')
            ->get();

        return view($this->prefix . $this->folder . 'index', compact('industries'));
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
