<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\FaqCategory;
use App\Models\Testimonial;

class BlogController extends Controller
{
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
            ->ordered()
            ->take(6)
            ->get();

        $category = FaqCategory::with('faqs')
            ->active()
            ->where('page', 'blog')
            ->latest('id')
            ->first();

        return view($this->prefix . $this->folder . 'index', compact('categories', 'blogs', 'testimonials', 'category'));
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
