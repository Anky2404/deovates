@extends('front.layouts.app')

@section('title', config('constants.PAGE_SEO.techstack.title'))
@section('meta_description', config('constants.PAGE_SEO.techstack.meta_description'))
@section('meta_keywords', config('constants.PAGE_SEO.techstack.meta_keywords'))
@section('content')

    <!-- Start Hero Section -->
    <!-- Hero -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ \App\Helper::heroBanner('tech-stack.avif', 'assets/front/img/hero/h1_hero.avif') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>Our Technology Stack</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Tech Stack</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Tools & Technologies Section -->
    <section class="py-5">
        <div class="container py-5">
            <div class="section-title st-center">
                @php
                    $techstackListingSection = $page?->sections->firstWhere('slug', 'techstack-page-listing-section');
                    $techstackListingContent = $techstackListingSection ? $sectionContents[$techstackListingSection->id] ?? [] : [];
                @endphp
                @include('front.partials._section_heading', [
                    'content' => $techstackListingContent,
                    'defaultTitle' => \App\Helper::sectionTitle('techstack', 'listing', 'title', 'Tools & Technologies'),
                    'defaultSubtitle' => \App\Helper::sectionTitle('techstack', 'listing', 'subtitle'),
                ])
            </div>

            @forelse ($technologies as $categoryName => $items)
                <div class="section-title st-start mt-5 mb-4">
                    <h3>{{ $categoryName }}</h3>
                </div>
                <div class="row g-4 mb-4">
                    @foreach ($items as $tech)
                        <div class="col-6 col-sm-4 col-lg-2 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="text-center p-4 rounded-4 h-100"
                                style="background:#f5f8fd;border:1px solid #e3e8f0;">
                                <i class="{{ $tech->icon ?: 'fas fa-code' }}" style="font-size:38px;color:#073965;"></i>
                                <h6 class="mt-3 mb-0" style="color:#073965;">{{ $tech->name }}</h6>
                            </div>
                        </div>
                    @endforeach
                </div>
            @empty
                <p class="text-center text-muted">Technologies will be listed here shortly.</p>
            @endforelse
        </div>
    </section>
    <!-- End Tools & Technologies Section -->

@endsection
