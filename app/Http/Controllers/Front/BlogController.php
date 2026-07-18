<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\Concerns\LoadsPageSections;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\FaqCategory;
use App\Models\Testimonial;

class BlogController extends Controller
{
    use LoadsPageSections;

    private $prefix = 'front.';
    private $folder = 'blog.';

    public function index()
    {
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

        [$page, $sectionContents] = $this->loadPageSections('blog');

        return view($this->prefix . $this->folder . 'index', compact('categories', 'blogs', 'testimonials', 'category', 'page', 'sectionContents'));
    }

    public function details($slug)
    {
        $blog = Blog::with(['category', 'author', 'tags'])
            ->active()
            ->where('slug', $slug)
            ->first();

        if (! $blog) {
            abort(404);
        }

        $blog->incrementViews();

        $related = Blog::active()
            ->published()
            ->where('id', '!=', $blog->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view($this->prefix . $this->folder . 'details', compact('blog', 'related'));
    }
}
