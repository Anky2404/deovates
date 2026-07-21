@extends('front.layouts.app')

@section('title', config('constants.PAGE_SEO.portfolios.title'))
@section('meta_description', config('constants.PAGE_SEO.portfolios.meta_description'))
@section('meta_keywords', config('constants.PAGE_SEO.portfolios.meta_keywords'))
@section('content')

    <!-- Start Hero Section -->
    <!-- Hero -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ \App\Helper::heroBanner('portfolios.png', 'assets/front/img/hero/h3_hero.avif') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>Our Portfolio</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Portfolio</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Work We're Proud Of Section -->
    <section class="py-5">
        <div class="container py-5">
            <div class="section-title st-center">
                @php
                    $portfoliosListingSection = $page?->sections->firstWhere('slug', 'portfolios-page-listing-section');
                    $portfoliosListingContent = $portfoliosListingSection ? $sectionContents[$portfoliosListingSection->id] ?? [] : [];
                @endphp
                @include('front.partials._section_heading', [
                    'content' => $portfoliosListingContent,
                    'defaultTitle' => \App\Helper::sectionTitle('portfolios', 'listing', 'title', "Work We're Proud Of"),
                    'defaultSubtitle' => \App\Helper::sectionTitle('portfolios', 'listing', 'subtitle'),
                ])
            </div>

            @if ($categories->isNotEmpty())
                <div class="d-flex flex-wrap justify-content-center gap-2 mb-5">
                    <span class="btn btn-sm rounded-pill px-4 py-2 btn-main">All</span>
                    @foreach ($categories as $category)
                        <span class="btn btn-sm rounded-pill px-4 py-2 btn-outline-secondary"
                            style="pointer-events:none;opacity:.7;">{{ $category->name }}</span>
                    @endforeach
                </div>
            @endif

            @if ($portfolios->isEmpty())
                <p class="text-center text-muted">Portfolio items will be listed here shortly.</p>
            @else
                <div class="row g-4">
                    @foreach ($portfolios as $portfolio)
                        <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="office-item h-100">
                                <div class="office-img">
                                    <img src="{{ \App\Helper::img($portfolio->featured_image) }}"
                                        alt="{{ $portfolio->title }}">
                                    <div class="office-icon"><i class="fas fa-briefcase"></i></div>
                                </div>
                                <div class="office-content">
                                    @if ($portfolio->category)
                                        <div class="content-card-meta">{{ $portfolio->category->name }}</div>
                                    @endif
                                    <h4>
                                        <a href="{{ route('front.portfolios.details', $portfolio->slug) }}"
                                            class="text-decoration-none" style="color:inherit;">{{ $portfolio->title }}</a>
                                    </h4>
                                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($portfolio->overview), 90) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
    <!-- End Work We're Proud Of Section -->

@endsection
