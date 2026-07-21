<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\Concerns\LoadsPageSections;
use App\Helper;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\FaqCategory;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
    use LoadsPageSections;

    private $prefix = 'front.';
    private $folder = 'blog.';

    public function index()
    {
        $viewData = Cache::remember('front.blog.index', Helper::CACHE_TTL, function () {
            $categories = BlogCategory::where('is_active', 1)
                ->latest('id')
                ->get();

            $blogs = Blog::with(['category', 'author'])
                ->active()
                ->published()
                ->latest('published_at')
                ->get();

            $testimonials = Testimonial::active()
                ->onPage('blog')
                ->ordered()
                ->take(6)
                ->get();

            $category = FaqCategory::with('activeFaqs')
                ->active()
                ->where('page', 'blog')
                ->latest('id')
                ->first();

            return compact('categories', 'blogs', 'testimonials', 'category');
        });

        [$page, $sectionContents] = $this->loadPageSections('blog');

        return view($this->prefix . $this->folder . 'index', $viewData + compact('page', 'sectionContents'));
    }

    public function details($slug)
    {
        $blog = Cache::remember("front.blog.details.{$slug}", Helper::CACHE_TTL, function () use ($slug) {
            return Blog::with(['category', 'author', 'tags'])
                ->active()
                ->where('slug', $slug)
                ->first();
        });

        if (! $blog) {
            abort(404);
        }

        $blog->incrementViews();

        $related = Cache::remember("front.blog.related.{$blog->id}", Helper::CACHE_TTL, function () use ($blog) {
            return Blog::active()
                ->published()
                ->where('id', '!=', $blog->id)
                ->latest('published_at')
                ->take(3)
                ->get();
        });

        return view($this->prefix . $this->folder . 'details', compact('blog', 'related'));
    }
}
