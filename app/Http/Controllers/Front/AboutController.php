<?php

namespace App\Http\Controllers\Front;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;

class AboutController extends Controller
{
    private $prefix = 'front.';
    private $folder = 'about.';

    public function index()
    {
        $data = Helper::readJSONData($this->folder . 'json');

        $testimonials = Testimonial::active()
            ->orderBy('display_order')
            ->latest('id')
            ->get();

        return view($this->prefix . $this->folder . 'index', compact('data', 'testimonials'));
    }
}
