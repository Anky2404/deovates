<?php

namespace App\Http\Controllers\Front;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use App\Models\Page;
use App\Models\Testimonial;

class AboutController extends Controller
{
    private $prefix = 'front.';
    private $folder = 'about.';

    public function index()
    {
        $data = Helper::readJSONData($this->folder . 'json');

        $testimonials = Testimonial::active()
            ->onPage('about')
            ->orderBy('display_order')
            ->latest('id')
            ->get();

        $category = FaqCategory::with('activeFaqs')
            ->active()
            ->where('page', 'about')
            ->latest('id')
            ->first();

        $aboutPage = Page::published()
            ->with(['sections' => fn ($q) => $q->wherePivot('is_active', true)->with('form.fields')])
            ->where('slug', 'about')
            ->first();

        $sectionContents = $aboutPage
            ? $aboutPage->sectionContents()->pluck('data', 'section_id')
                ->map(fn ($data) => Helper::replacePlaceholders($data))
                ->toArray()
            : [];

        return view($this->prefix . $this->folder . 'index', compact('data', 'testimonials', 'category', 'aboutPage', 'sectionContents'));
    }
}
