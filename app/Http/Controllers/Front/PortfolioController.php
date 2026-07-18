<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\Concerns\LoadsPageSections;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;

class PortfolioController extends Controller
{
    use LoadsPageSections;

    private $prefix = 'front.';
    private $folder = 'portfolios.';

    public function index()
    {
        $categories = PortfolioCategory::where('is_active', 1)
            ->latest('id')
            ->get();

        $portfolios = Portfolio::with('category')
            ->active()
            ->ordered()
            ->latest('id')
            ->get();

        [$page, $sectionContents] = $this->loadPageSections('portfolios');

        return view($this->prefix . $this->folder . 'index', compact('categories', 'portfolios', 'page', 'sectionContents'));
    }

    public function details($slug)
    {
        $portfolio = Portfolio::with(['category', 'images', 'skills'])
            ->active()
            ->where('slug', $slug)
            ->first();

        if (! $portfolio) {
            abort(404);
        }

        $portfolio->incrementViews();

        $related = Portfolio::active()
            ->where('id', '!=', $portfolio->id)
            ->ordered()
            ->latest('id')
            ->take(3)
            ->get();

        return view($this->prefix . $this->folder . 'details', compact('portfolio', 'related'));
    }
}
