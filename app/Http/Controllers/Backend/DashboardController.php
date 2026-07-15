<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\AuthLog;
use App\Models\Blog;
use App\Models\CareerApplication;
use App\Models\CaseStudy;
use App\Models\Enquiry;
use App\Models\NewsletterSubscriber;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    private string $prefix = 'backend.';
    private string $folder = 'dashboard.';

    public function index(): View
    {
        $stats = [
            'enquiries_new'       => Enquiry::new()->count(),
            'enquiries_follow_up' => Enquiry::requiresFollowUp()->count(),
            'blogs'               => Blog::published()->count(),
            'services'            => Service::active()->count(),
            'portfolios'          => Portfolio::active()->count(),
            'case_studies'        => CaseStudy::active()->count(),
            'users'               => User::active()->count(),
            'newsletter'          => NewsletterSubscriber::active()->count(),
        ];

        $enquiryStatusBreakdown = Enquiry::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $contentDistribution = [
            'Blogs'         => Blog::count(),
            'Services'      => Service::count(),
            'Portfolios'    => Portfolio::count(),
            'Case Studies'  => CaseStudy::count(),
            'Testimonials'  => Testimonial::count(),
        ];

        $recentEnquiries = Enquiry::latest()->take(5)->get();

        $followUpEnquiries = Enquiry::requiresFollowUp()
            ->orderBy('follow_up_at')
            ->take(5)
            ->get();

        $careerPipeline = CareerApplication::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $recentActivity = ActivityLog::with('user')->latest()->take(8)->get();

        $recentAuthLogs = AuthLog::with('user')->latest()->take(8)->get();

        $topContent = Blog::query()
            ->select(['title', 'views'])
            ->selectRaw("'Blog' as type")
            ->orderByDesc('views')
            ->take(5)
            ->get()
            ->merge(
                Portfolio::query()
                    ->select(['title', 'views'])
                    ->selectRaw("'Portfolio' as type")
                    ->orderByDesc('views')
                    ->take(5)
                    ->get()
            )
            ->sortByDesc('views')
            ->take(5)
            ->values();

        return view($this->prefix . $this->folder . 'index', compact(
            'stats',
            'enquiryStatusBreakdown',
            'contentDistribution',
            'recentEnquiries',
            'followUpEnquiries',
            'careerPipeline',
            'recentActivity',
            'recentAuthLogs',
            'topContent'
        ));
    }
}
