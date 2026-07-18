<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\Concerns\LoadsPageSections;
use App\Models\FaqCategory;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Log;

class FaqController extends Controller
{
    use LoadsPageSections;

    public function index()
    {
        try {
            $category = FaqCategory::with('activeFaqs')
                ->active()
                ->where('page', 'faq')
                ->latest('id')
                ->first();

            $testimonials = Testimonial::active()
                ->onPage('faq')
                ->ordered()
                ->take(6)
                ->get();

            [$page, $sectionContents] = $this->loadPageSections('faq');

            return view('front.faq.index', compact('category', 'testimonials', 'page', 'sectionContents'));
        } catch (\Throwable $e) {
            Log::error('FAQ Page Error', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'trace'   => $e->getTraceAsString(),
            ]);

            if (config('app.debug')) {
                abort(500, $e->getMessage());
            }

            return redirect('/')
                ->with('error', 'Something went wrong. Please try again later.');
        }
    }
}
