<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\Concerns\LoadsPageSections;

class LegalController extends Controller
{
    use LoadsPageSections;

    public function privacy()
    {
        [$page, $sectionContents] = $this->loadPageSections('legal-privacy');

        return view('front.legal.privacy', compact('page', 'sectionContents'));
    }

    public function terms()
    {
        [$page, $sectionContents] = $this->loadPageSections('legal-terms');

        return view('front.legal.terms', compact('page', 'sectionContents'));
    }
}
