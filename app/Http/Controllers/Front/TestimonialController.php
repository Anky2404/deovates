<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::active()
            ->orderBy('display_order')
            ->latest('id')
            ->get();

        return view('front.testimonials.index', compact('testimonials'));
    }
}
