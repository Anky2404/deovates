<?php

namespace App\Http\Controllers\Front;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\FaqCategory;
use App\Models\Industry;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\Service;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
     private $prefix = 'front.';
    private $folder = 'home.';
    //Index Function
public function index()
{
    try {

        $data = Helper::readJSONData($this->folder . 'json');

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



        $casestudies = CaseStudy::where('is_active', 1)
            ->latest('id')
            ->take(8)
            ->get();

        $blogs = Blog::where('is_active', 1)
            ->latest('id')
            ->take(8)
            ->get();

        $category = FaqCategory::with('faqs')
            ->active()
            ->where('page', 'home')
            ->latest('id')
            ->first();

            // dd($portfolios);

        return view($this->prefix . $this->folder . 'index', compact(
            'data',
            'category',
            'blogs',
            'services',
            'industries',
            'technologies',
            'casestudies',
            'portfolios',
            'portfolio_categories'
        ));

    } catch (\Throwable $e) {
        dd($e->getMessage());

        Log::error('Home Page Error', [
            'message' => $e->getMessage(),
            'file'    => $e->getFile(),
            'line'    => $e->getLine(),
            'trace'   => $e->getTraceAsString(),
        ]);

        if (config('app.debug')) {
            abort(500, $e->getMessage());
        }

        return redirect('/')
            ->with('error', 'Something went wrong. Please try again later.');
    }
}
}
