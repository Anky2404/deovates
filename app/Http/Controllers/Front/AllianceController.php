<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\Concerns\LoadsPageSections;
use App\Models\Partner;

class AllianceController extends Controller
{
    use LoadsPageSections;

    public function index()
    {
        $partners = Partner::active()
            ->ordered()
            ->latest('id')
            ->get();

        [$page, $sectionContents] = $this->loadPageSections('alliances');

        return view('front.alliances.index', compact('partners', 'page', 'sectionContents'));
    }
}
