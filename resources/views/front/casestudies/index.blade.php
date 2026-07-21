@extends('front.layouts.app')

@section('title', config('constants.PAGE_SEO.casestudies.title'))
@section('meta_description', config('constants.PAGE_SEO.casestudies.meta_description'))
@section('meta_keywords', config('constants.PAGE_SEO.casestudies.meta_keywords'))
@section('content')

    <!-- Start Hero Section -->
    <!-- Hero -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ \App\Helper::heroBanner('case-studies.avif', 'assets/front/img/hero/h3_hero.avif') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>Case Studies</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Case Studies</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Real Results, Real Businesses Section -->
    <section class="py-5">
        <div class="container py-5">
            <div class="section-title st-center">
                @php
                    $casestudiesListingSection = $page?->sections->firstWhere('slug', 'casestudies-page-listing-section');
                    $casestudiesListingContent = $casestudiesListingSection ? $sectionContents[$casestudiesListingSection->id] ?? [] : [];
                @endphp
                @include('front.partials._section_heading', [
                    'content' => $casestudiesListingContent,
                    'defaultTitle' => \App\Helper::sectionTitle('casestudies', 'listing', 'title', 'Real Results, Real Businesses'),
                    'defaultSubtitle' => \App\Helper::sectionTitle('casestudies', 'listing', 'subtitle'),
                ])
            </div>

            @if ($casestudies->isEmpty())
                <p class="text-center text-muted">Case studies will be listed here shortly.</p>
            @else
                <div class="row g-4">
                    @foreach ($casestudies as $item)
                        <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="office-item h-100">
                                <div class="office-img">
                                    <img src="{{ \App\Helper::img($item->featured_image) }}" alt="{{ $item->title }}">
                                    <div class="office-icon"><i class="fas fa-chart-line"></i></div>
                                </div>
                                <div class="office-content">
                                    <div class="content-card-meta">
                                        @if ($item->category)
                                            <span>{{ $item->category->name }}</span>
                                        @endif
                                        @if ($item->industry)
                                            <span>{{ $item->industry }}</span>
                                        @endif
                                    </div>
                                    <h4>
                                        <a href="{{ route('front.casestudies.details', $item->slug) }}"
                                            class="text-decoration-none" style="color:inherit;">{{ $item->title }}</a>
                                    </h4>
                                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($item->overview), 90) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
    <!-- End Real Results, Real Businesses Section -->

@endsection
