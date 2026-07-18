<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\Concerns\LoadsPageSections;

class PricingController extends Controller
{
    use LoadsPageSections;

    public function index()
    {
        [$page, $sectionContents] = $this->loadPageSections('pricing');

        return view('front.pricing.index', compact('page', 'sectionContents'));
    }
}
