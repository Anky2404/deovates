<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::active()
            ->orderBy('display_order')
            ->latest('id')
            ->get();

        $category = FaqCategory::with('faqs')
            ->active()
            ->where('page', 'testimonials')
            ->latest('id')
            ->first();

        return view('front.testimonials.index', compact('testimonials', 'category'));
    }
}
