@extends('front.layouts.app')

@section('title', config('constants.PAGE_SEO.blog.title'))
@section('meta_description', config('constants.PAGE_SEO.blog.meta_description'))
@section('meta_keywords', config('constants.PAGE_SEO.blog.meta_keywords'))
@section('content')

    <!-- Start Hero Section -->
    <!-- Hero -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ \App\Helper::heroBanner('blog.avif', 'assets/front/img/hero/h2_hero.avif') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>Our Blog</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Blog</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Insights & Ideas Section -->
    @php
        $blogListingSection = $page?->sections->firstWhere('slug', 'blog-listing-section');
        $blogListingContent = $blogListingSection ? $sectionContents[$blogListingSection->id] ?? [] : [];
    @endphp
    <section class="py-5">
        <div class="container py-5">
            <div class="section-title st-center">
                @include('front.common._section_heading', [
                    'content' => $blogListingContent,
                    'defaultTitle' => \App\Helper::sectionTitle('blog', 'listing', 'title', 'Insights & Ideas'),
                    'defaultSubtitle' => \App\Helper::sectionTitle('blog', 'listing', 'subtitle'),
                ])
            </div>

            @if ($blogs->isEmpty())
                <p class="text-center text-muted">Blog posts will be listed here shortly.</p>
            @else
                <div class="row g-4">
                    @foreach ($blogs as $blog)
                        <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="office-item h-100">
                                <div class="office-img">
                                    <img src="{{ !empty($blog->featured_image) && \Illuminate\Support\Facades\Storage::disk('public')->exists($blog->featured_image) ? asset('storage/' . $blog->featured_image) : asset('assets/front/img/default-img.avif') }}"
                                        alt="{{ $blog->title }}">
                                    <div class="office-icon"><i class="fas fa-pen-nib"></i></div>
                                </div>
                                <div class="office-content">
                                    <div class="content-card-meta">
                                        @if ($blog->category)
                                            <span>{{ $blog->category->name }}</span>
                                        @endif
                                        <span><i class="far fa-clock me-1"></i>{{ $blog->reading_time }} min read</span>
                                    </div>
                                    <h4>
                                        <a href="{{ route('front.blog.details', $blog->slug) }}" class="text-decoration-none"
                                            style="color:inherit;">{{ $blog->title }}</a>
                                    </h4>
                                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($blog->excerpt), 90) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
    <!-- End Insights & Ideas Section -->

<!-- Start Our Development Process Section -->
@include('front.common._roadmap_section', [
    'page' => $page,
    'sectionContents' => $sectionContents,
    'defaultLabel' => 'Our Development Process',
    'defaultTitle' => \App\Helper::sectionTitle('blog', 'roadmap', 'title', 'From Vision to Digital Success'),
    'defaultSubtitle' => \App\Helper::sectionTitle('blog', 'roadmap', 'subtitle'),
])
<!-- End Our Development Process Section -->

    <!-- Start Testimonials Section -->
    <!-- Testimonials -->
    @include('front.common._testimonials_section', [
        'page' => $page,
        'sectionContents' => $sectionContents,
        'testimonials' => $testimonials,
        'defaultTitle' => \App\Helper::sectionTitle('blog', 'testimonials', 'title', 'What Our Clients Say'),
        'defaultSubtitle' => \App\Helper::sectionTitle('blog', 'testimonials', 'subtitle'),
    ])
    <!-- End Testimonials Section -->



    <!-- Start CTA Section -->
    <!-- CTA -->
    @include('front.common._cta_section', [
        'page' => $page,
        'sectionContents' => $sectionContents,
        'defaultTitle' => "LET'S BUILD SOMETHING EXCEPTIONAL",
        'defaultSubtitle' => 'Transform Your Vision into Powerful Digital Solutions',
    ])
    <!-- End CTA Section -->

    <!-- Start FAQ Section -->
    @include('front.common._faq_section', [
        'page' => $page,
        'sectionContents' => $sectionContents,
        'category' => $category,
        'defaultTitle' => \App\Helper::sectionTitle('blog', 'faq', 'title', 'Frequently Asked Questions'),
        'defaultSubtitle' => \App\Helper::sectionTitle('blog', 'faq', 'subtitle'),
    ])
    <!-- End FAQ Section -->


@endsection
