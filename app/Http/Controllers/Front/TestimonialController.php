<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\Concerns\LoadsPageSections;
use App\Models\FaqCategory;
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

        $category = FaqCategory::with('activeFaqs')
            ->active()
            ->where('page', 'testimonials')
            ->latest('id')
            ->first();

        [$page, $sectionContents] = $this->loadPageSections('testimonials');

        return view('front.testimonials.index', compact('testimonials', 'category', 'page', 'sectionContents'));
    }
}
