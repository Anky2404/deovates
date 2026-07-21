<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\Concerns\LoadsPageSections;
use App\Helper;
use App\Models\CaseStudy;
use App\Models\CaseStudyCategory;
use Illuminate\Support\Facades\Cache;

class CaseStudyController extends Controller
{
    use LoadsPageSections;

    private $prefix = 'front.';
    private $folder = 'casestudies.';

    public function index()
    {
        $viewData = Cache::remember('front.casestudies.index', Helper::CACHE_TTL, function () {
            $categories = CaseStudyCategory::where('is_active', 1)
                ->latest('id')
                ->get();

            $casestudies = CaseStudy::with('category')
                ->active()
                ->ordered()
                ->latest('id')
                ->get();

            return compact('categories', 'casestudies');
        });

        [$page, $sectionContents] = $this->loadPageSections('casestudies');

        return view($this->prefix . $this->folder . 'index', $viewData + compact('page', 'sectionContents'));
    }

    public function details($slug)
    {
        $casestudy = Cache::remember("front.casestudies.details.{$slug}", Helper::CACHE_TTL, function () use ($slug) {
            return CaseStudy::with('category')
                ->active()
                ->where('slug', $slug)
                ->first();
        });

        if (! $casestudy) {
            abort(404);
        }

        $related = Cache::remember("front.casestudies.related.{$casestudy->id}", Helper::CACHE_TTL, function () use ($casestudy) {
            return CaseStudy::active()
                ->where('id', '!=', $casestudy->id)
                ->ordered()
                ->latest('id')
                ->take(3)
                ->get();
        });

        return view($this->prefix . $this->folder . 'details', compact('casestudy', 'related'));
    }
}
