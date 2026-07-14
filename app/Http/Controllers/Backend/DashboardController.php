<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Career;
use App\Models\CaseStudy;
use App\Models\Enquiry;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    private string $prefix = 'backend.';
    private string $folder = 'dashboard.';

    public function index(): View
    {
        $stats = [
            'users' => User::count(),
            'blogs' => Blog::count(),
            'services' => Service::count(),
            'portfolios' => Portfolio::count(),
            'case_studies' => CaseStudy::count(),
            'careers' => Career::count(),
            'enquiries' => Enquiry::where('status', 'responded')->count(),
        ];

        $recentBlogs = Blog::with('category')
            ->latest()
            ->take(5)
            ->get();

        $recentEnquiries = Enquiry::latest()
            ->take(5)
            ->get();

        return view($this->prefix . $this->folder . 'index', compact('stats', 'recentBlogs', 'recentEnquiries'));
    }
}
