<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\CaseStudy;
use App\Models\CaseStudyCategory;

class CaseStudyController extends Controller
{
    private $prefix = 'front.';
    private $folder = 'casestudies.';

    public function index()
    {
        $categories = CaseStudyCategory::where('is_active', 1)
            ->latest('id')
            ->get();

        $casestudies = CaseStudy::with('category')
            ->active()
            ->ordered()
            ->latest('id')
            ->get();

        return view($this->prefix . $this->folder . 'index', compact('categories', 'casestudies'));
    }

    public function details($slug)
    {
        $casestudy = CaseStudy::with('category')
            ->active()
            ->where('slug', $slug)
            ->first();

        if (! $casestudy) {
            abort(404);
        }

        $related = CaseStudy::active()
            ->where('id', '!=', $casestudy->id)
            ->ordered()
            ->latest('id')
            ->take(3)
            ->get();

        return view($this->prefix . $this->folder . 'details', compact('casestudy', 'related'));
    }
}
