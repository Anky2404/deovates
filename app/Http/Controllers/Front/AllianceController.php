<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Partner;

class AllianceController extends Controller
{
    public function index()
    {
        $partners = Partner::active()
            ->ordered()
            ->latest('id')
            ->get();

        return view('front.alliances.index', compact('partners'));
    }
}
