@extends('front.layouts.app')

@section('title', config('constants.PAGE_SEO.industries.title'))
@section('meta_description', config('constants.PAGE_SEO.industries.meta_description'))
@section('meta_keywords', config('constants.PAGE_SEO.industries.meta_keywords'))
@section('content')

    <!-- Start Hero Section -->
    <!-- Hero -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ \App\Helper::heroBanner('industries.png', 'assets/front/img/hero/h1_hero.avif') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>Industries We Serve</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Industries</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Solutions Built For Your Industry Section -->
    <section class="py-5">
        <div class="container py-5">
            <div class="section-title st-center">
                @php
                    $industriesListingSection = $page?->sections->firstWhere('slug', 'industries-page-listing-section');
                    $industriesListingContent = $industriesListingSection ? $sectionContents[$industriesListingSection->id] ?? [] : [];
                @endphp
                @include('front.partials._section_heading', [
                    'content' => $industriesListingContent,
                    'defaultTitle' => \App\Helper::sectionTitle('industries', 'listing', 'title', 'Solutions Built For Your Industry'),
                    'defaultSubtitle' => \App\Helper::sectionTitle('industries', 'listing', 'subtitle'),
                ])
            </div>

            @if ($industries->isEmpty())
                <p class="text-center text-muted">Industries will be listed here shortly.</p>
            @else
                <div class="row g-4">
                    @foreach ($industries as $industry)
                        <div class="col-sm-6 col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                            <a href="{{ route('front.industries.details', $industry->slug) }}"
                                class="text-decoration-none">
                                <div class="office-item icon-only h-100">
                                    <div class="office-img">
                                        <i class="{{ $industry->icon ?: 'bx bx-buildings' }}"></i>
                                    </div>
                                    <div class="office-content text-center">
                                        <h4>{{ $industry->name }}</h4>
                                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($industry->description), 80) }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
    <!-- End Solutions Built For Your Industry Section -->

@endsection
