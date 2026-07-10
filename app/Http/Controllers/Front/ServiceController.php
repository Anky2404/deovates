<?php

namespace App\Http\Controllers\Front;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\PortfolioCategory;
use App\Models\Service;
use App\Models\Testimonial;
class ServiceController extends Controller
{
    private $prefix = 'frontend.';
    private $folder = 'services.';
    //Index Function
   public function index()
{
    $data = Helper::readJSONData($this->folder . 'json') ?? [];

    $services = Service::where('is_active', 1)
        ->latest()
        ->limit(6)
        ->get();

    $portfolio_categories = PortfolioCategory::with(['portfolios' => function ($query) {
            $query->where('is_active', 1);
        }])
        ->where('is_active', 1)
        ->latest()
        ->get();

    $testimonials = Testimonial::where('location','service')->active()
        ->orderBy('display_order', 'asc')
        ->latest()
        ->get();

    return view($this->prefix . $this->folder . 'index', [
        'data' => $data,
        'services' => $services,
        'portfolio_categories' => $portfolio_categories,
        'testimonials' => $testimonials
    ]);
}


  public function details($uuid)
{

    $service = Service::where('uuid', $uuid)
        ->where('is_active', 1)
        ->first();

    if (!$service) {
        return back()->with('error', 'Service not found.');
    }

    // Get latest 6 services
    $services = Service::where('is_active', 1)
        ->where('uuid', '!=', $uuid)
        ->orderBy('id', 'desc')
        ->limit(6)
        ->get();

    return view($this->prefix . $this->folder . 'details', compact('service', 'services'));
}
}
