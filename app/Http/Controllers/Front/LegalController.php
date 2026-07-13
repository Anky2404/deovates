<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class LegalController extends Controller
{
    public function privacy()
    {
        return view('front.legal.privacy');
    }

    public function terms()
    {
        return view('front.legal.terms');
    }
}
