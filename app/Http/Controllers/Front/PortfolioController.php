<?php

namespace App\Http\Controllers\Front;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\Concerns\LoadsPageSections;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use Illuminate\Support\Facades\Cache;

class PortfolioController extends Controller
{
    use LoadsPageSections;

    private $prefix = 'front.';

    private $folder = 'portfolios.';

    public function index()
    {
        $viewData = Cache::remember('front.portfolios.index', Helper::CACHE_TTL, function () {
            $categories = PortfolioCategory::where('is_active', 1)
                ->latest('id')
                ->get();

            $portfolios = Portfolio::with('category')
                ->active()
                ->ordered()
                ->latest('id')
                ->get();

            return compact('categories', 'portfolios');
        });

        [$page, $sectionContents] = $this->loadPageSections('portfolios');

        return view($this->prefix.$this->folder.'index', $viewData + compact('page', 'sectionContents'));
    }

    public function details($slug)
    {
        $portfolio = Cache::remember("front.portfolios.details.{$slug}", Helper::CACHE_TTL, function () use ($slug) {
            return Portfolio::with(['category', 'images', 'skills'])
                ->active()
                ->where('slug', $slug)
                ->first();
        });

        if (! $portfolio) {
            abort(404);
        }

        $portfolio->incrementViews();

        $related = Cache::remember("front.portfolios.related.{$portfolio->id}", Helper::CACHE_TTL, function () use ($portfolio) {
            return Portfolio::active()
                ->where('id', '!=', $portfolio->id)
                ->ordered()
                ->latest('id')
                ->take(3)
                ->get();
        });

        return view($this->prefix.$this->folder.'details', compact('portfolio', 'related'));
    }
}
