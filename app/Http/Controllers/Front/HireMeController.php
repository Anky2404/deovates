<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\Concerns\LoadsPageSections;

class HireMeController extends Controller
{
    use LoadsPageSections;

    public function index()
    {
        [$page, $sectionContents] = $this->loadPageSections('hireme');

        return view('front.hireme.index', compact('page', 'sectionContents'));
    }
}
