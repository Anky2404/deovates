<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Helper;
use App\Http\Controllers\Front\Concerns\LoadsPageSections;
use App\Models\Partner;
use Illuminate\Support\Facades\Cache;

class AllianceController extends Controller
{
    use LoadsPageSections;

    public function index()
    {
        $partners = Cache::remember('front.alliances.index', Helper::CACHE_TTL, function () {
            return Partner::active()
                ->ordered()
                ->latest('id')
                ->get();
        });

        [$page, $sectionContents] = $this->loadPageSections('alliances');

        return view('front.alliances.index', compact('partners', 'page', 'sectionContents'));
    }
}
