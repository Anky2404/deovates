<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Technology;

class TechStackController extends Controller
{
    public function index()
    {
        $technologies = Technology::with('category')
            ->active()
            ->ordered()
            ->latest('id')
            ->get()
            ->groupBy(fn ($tech) => $tech->category->name ?? 'Other');

        return view('front.techstack.index', compact('technologies'));
    }
}
