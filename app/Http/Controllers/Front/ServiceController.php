<?php

namespace App\Http\Controllers\Front;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\Concerns\LoadsPageSections;
use App\Models\FaqCategory;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Cache;

class ServiceController extends Controller
{
    use LoadsPageSections;

    private $prefix = 'front.';

    private $folder = 'services.';

    public function index()
    {
        $viewData = Cache::remember('front.services.index', Helper::CACHE_TTL, function () {
            $data = Helper::readJSONData($this->folder.'json');

            $services = Service::active()
                ->ordered()
                ->latest('id')
                ->get();

            $testimonials = Testimonial::active()
                ->onPage('services')
                ->orderBy('display_order')
                ->latest('id')
                ->take(6)
                ->get();

            $category = FaqCategory::with('activeFaqs')
                ->active()
                ->where('page', 'services')
                ->latest('id')
                ->first();

            return compact('data', 'services', 'testimonials', 'category');
        });

        [$page, $sectionContents] = $this->loadPageSections('services');

        return view($this->prefix.$this->folder.'index', $viewData + compact('page', 'sectionContents'));
    }

    public function details($slug)
    {
        $service = Cache::remember("front.services.details.{$slug}", Helper::CACHE_TTL, function () use ($slug) {
            return Service::active()
                ->where('slug', $slug)
                ->with(['faqs', 'features', 'challenges', 'technologies', 'problems', 'solutions'])
                ->first();
        });

        if (! $service) {
            abort(404);
        }

        $service->incrementViews();

        $related = Cache::remember("front.services.related.{$service->id}", Helper::CACHE_TTL, function () use ($service) {
            return Service::active()
                ->where('id', '!=', $service->id)
                ->ordered()
                ->latest('id')
                ->take(3)
                ->get();
        });

        // Placeholder problems until populated
        $problems = $service->problems->isNotEmpty()
            ? $service->problems
            : collect([
                (object) [
                    'image' => 'assets/front/img/why-4.png',
                    'title' => 'Outdated or Slow Systems',
                    'description' => 'Legacy platforms and slow-loading pages frustrate users and quietly cost you customers every day.',
                ],
                (object) [
                    'image' => 'assets/front/img/why-3.png',
                    'title' => 'Poor User Experience',
                    'description' => 'Confusing navigation and clunky workflows drive visitors away before they ever convert.',
                ],
                (object) [
                    'image' => 'assets/front/img/why-1.png',
                    'title' => 'Limited Scalability',
                    'description' => "Systems that can't grow with you become a bottleneck the moment your business gains traction.",
                ],
            ]);

        $solutions = $service->solutions->isNotEmpty()
            ? $service->solutions
            : collect([
                (object) [
                    'icon' => 'fas fa-bolt',
                    'title' => 'Modern, Optimized Architecture',
                    'description' => 'We rebuild on fast, reliable, modern technology so performance is never the reason you lose a customer.',
                ],
                (object) [
                    'icon' => 'fas fa-users',
                    'title' => 'Intuitive, User-Centered Design',
                    'description' => 'We design clear, friction-free experiences that guide users to convert and keep coming back.',
                ],
                (object) [
                    'icon' => 'fas fa-chart-line',
                    'title' => 'Scalable by Design',
                    'description' => 'Every solution is architected to scale smoothly as your traffic and business grow.',
                ],
            ]);

        return view($this->prefix.$this->folder.'details', compact('service', 'related', 'problems', 'solutions'));
    }
}
