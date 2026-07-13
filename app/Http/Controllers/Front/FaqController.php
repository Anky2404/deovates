<?php

namespace App\Http\Controllers\Front;

use App\Helper;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    public function index()
    {
        // FaqCategory/Faq DB records are currently just placeholder
        // seed data ("asdf" etc.) — reusing the well-authored static
        // FAQ copy from services.json until real FAQ content is added.
        $data = Helper::readJSONData('services.json');
        $faqs = $data['faq']['items'] ?? [];

        return view('front.faq.index', compact('faqs'));
    }
}
