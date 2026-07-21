<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\Concerns\LoadsPageSections;
use App\Models\FaqCategory;
use App\Models\GoogleReview;
use App\Models\SiteSetting;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    use LoadsPageSections;

    public function index()
    {
        $testimonials = Testimonial::active()
            ->orderBy('display_order')
            ->latest('id')
            ->get();

        $googleReviews = GoogleReview::active()->latest('review_time')->get();
        $googleRating = SiteSetting::get('google_reviews_average_rating');
        $googleTotalCount = SiteSetting::get('google_reviews_total_count');

        $category = FaqCategory::with('activeFaqs')
            ->active()
            ->where('page', 'testimonials')
            ->latest('id')
            ->first();

        [$page, $sectionContents] = $this->loadPageSections('testimonials');

        return view('front.testimonials.index', compact(
            'testimonials',
            'googleReviews',
            'googleRating',
            'googleTotalCount',
            'category',
            'page',
            'sectionContents'
        ));
    }
}
