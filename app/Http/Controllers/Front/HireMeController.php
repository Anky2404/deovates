<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class HireMeController extends Controller
{
    public function index()
    {
        return view('front.hireme.index');
    }
}
