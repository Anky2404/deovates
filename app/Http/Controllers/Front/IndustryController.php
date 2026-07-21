<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\Concerns\LoadsPageSections;
use App\Helper;
use App\Models\Industry;
use Illuminate\Support\Facades\Cache;

class IndustryController extends Controller
{
    use LoadsPageSections;

    private $prefix = 'front.';
    private $folder = 'industries.';

    public function index()
    {
        $industries = Cache::remember('front.industries.index', Helper::CACHE_TTL, function () {
            return Industry::active()
                ->ordered()
                ->latest('id')
                ->get();
        });

        [$page, $sectionContents] = $this->loadPageSections('industries');

        return view($this->prefix . $this->folder . 'index', compact('industries', 'page', 'sectionContents'));
    }

    public function details($slug)
    {
        $industry = Cache::remember("front.industries.details.{$slug}", Helper::CACHE_TTL, function () use ($slug) {
            return Industry::active()
                ->where('slug', $slug)
                ->first();
        });

        if (! $industry) {
            abort(404);
        }

        $industry->increment('views');

        $related = Cache::remember("front.industries.related.{$industry->id}", Helper::CACHE_TTL, function () use ($industry) {
            return Industry::active()
                ->where('id', '!=', $industry->id)
                ->ordered()
                ->latest('id')
                ->take(4)
                ->get();
        });

        return view($this->prefix . $this->folder . 'details', compact('industry', 'related'));
    }
}
