<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Helper;
use App\Http\Controllers\Front\Concerns\LoadsPageSections;
use App\Models\Technology;
use Illuminate\Support\Facades\Cache;

class TechStackController extends Controller
{
    use LoadsPageSections;

    public function index()
    {
        $technologies = Cache::remember('front.techstack.index', Helper::CACHE_TTL, function () {
            return Technology::with('category')
                ->active()
                ->ordered()
                ->latest('id')
                ->get()
                ->groupBy(fn ($tech) => $tech->category->name ?? 'Other');
        });

        [$page, $sectionContents] = $this->loadPageSections('techstack');

        return view('front.techstack.index', compact('technologies', 'page', 'sectionContents'));
    }
}
