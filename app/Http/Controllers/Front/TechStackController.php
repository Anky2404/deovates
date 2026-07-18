<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\Concerns\LoadsPageSections;
use App\Models\Technology;

class TechStackController extends Controller
{
    use LoadsPageSections;

    public function index()
    {
        $technologies = Technology::with('category')
            ->active()
            ->ordered()
            ->latest('id')
            ->get()
            ->groupBy(fn ($tech) => $tech->category->name ?? 'Other');

        [$page, $sectionContents] = $this->loadPageSections('techstack');

        return view('front.techstack.index', compact('technologies', 'page', 'sectionContents'));
    }
}
