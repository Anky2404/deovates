<?php

namespace App\Http\Controllers\Front;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\FaqCategory;
use App\Models\Industry;
use App\Models\Page;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Technology;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    private $prefix = 'front.';

    private $folder = 'home.';

    public function index()
    {
        try {

        dd(SiteSetting::get('google_reviews_average_rating'),SiteSetting::get('google_reviews_total_count'));

            $viewData = Cache::remember('front.home.index', Helper::CACHE_TTL, function () {
                $data = Helper::readJSONData($this->folder.'json');

                $services = Service::where('is_active', 1)
                    ->latest('id')
                    ->take(6)
                    ->get();

                $portfolio_categories = PortfolioCategory::where('is_active', 1)
                    ->latest('id')
                    ->limit(10)
                    ->get();

                $portfolios = Portfolio::with('category')
                    ->where('is_active', 1)
                    ->latest('id')
                    ->get();
                $technologies = Technology::with('category')
                    ->where('is_active', 1)
                    ->latest('id')
                    ->get();

                $slugs = [
                    'healthcare',
                    'education',
                    'finance-fintech',
                    'e-commerce',
                    'technology-saas',
                    'real-estate',
                    'logistics-transportation',
                    'manufacturing',
                ];

                $industries = Industry::where('is_active', 1)
                    ->whereIn('slug', $slugs)
                    ->get();

                $casestudies = CaseStudy::with('category')
                    ->where('is_active', 1)
                    ->latest('id')
                    ->take(8)
                    ->get();

                $blogs = Blog::where('is_active', 1)
                    ->latest('id')
                    ->take(8)
                    ->get();

                $category = FaqCategory::with('activeFaqs')
                    ->active()
                    ->where('page', 'home')
                    ->latest('id')
                    ->first();

                $testimonials = Testimonial::active()
                    ->onPage('home')
                    ->ordered()
                    ->take(6)
                    ->get();

                $homePage = Page::published()
                    ->with(['sections' => fn ($q) => $q->wherePivot('is_active', true)->with('form.fields')])
                    ->where('slug', 'home')
                    ->first();

                $sectionContents = $homePage
                    ? $homePage->sectionContents()->pluck('data', 'section_id')
                        ->map(fn ($data) => Helper::replacePlaceholders($data))
                        ->toArray()
                    : [];

                return compact(
                    'data',
                    'category',
                    'blogs',
                    'services',
                    'industries',
                    'technologies',
                    'casestudies',
                    'portfolios',
                    'portfolio_categories',
                    'testimonials',
                    'homePage',
                    'sectionContents'
                );
            });

            return view($this->prefix.$this->folder.'index', $viewData);

        } catch (\Throwable $e) {
            Log::error('Home Page Error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            if (config('app.debug')) {
                abort(500, $e->getMessage());
            }

            return redirect('/')
                ->with('error', 'Something went wrong. Please try again later.');
        }
    }
}
