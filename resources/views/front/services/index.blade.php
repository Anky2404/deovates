@extends('front.layouts.app')

@section('title', $data['meta_title'] ?? $data['title'] ?? config('constants.PAGE_SEO.services.title'))
@section('meta_description', $data['meta_description'] ?? config('constants.PAGE_SEO.services.meta_description'))
@section('meta_keywords', $data['meta_keywords'] ?? config('constants.PAGE_SEO.services.meta_keywords'))
@section('content')

    <!-- Start Hero Section -->
    <!-- Hero -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ asset('assets/front/img/hero/h2_hero.avif') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>Our Services</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Services</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Services Grid Section -->
    <!-- Services grid -->
    @php
        $servicesGridSection = $page?->sections->firstWhere('slug', 'services-grid-section');
        $servicesGridContent = $servicesGridSection ? $sectionContents[$servicesGridSection->id] ?? [] : [];
    @endphp
    <section class="services container-fluid service overflow-hidden py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title st-center">
                        @include('front.common._section_heading', [
                            'content' => $servicesGridContent,
                            'defaultTitle' => \App\Helper::sectionTitle('services', 'grid', 'title', 'What We Offer'),
                            'defaultSubtitle' => \App\Helper::sectionTitle('services', 'grid', 'subtitle'),
                        ])
                    </div>

                    @if ($services->isEmpty())
                        <p class="text-center text-muted">Services will be listed here shortly.</p>
                    @else
                        <div class="row g-4">
                            @foreach ($services as $service)
                                <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="service-item">
                                        <div class="service-inner">
                                            <div class="service-img">
                                                <img src="{{ \App\Helper::img($service->featured_image) }}"
                                                    class="img-fluid w-100 rounded" alt="{{ $service->title }}">
                                            </div>
                                            <div class="service-title">
                                                <div class="service-title-name">
                                                    <div class="bg-primary text-center rounded p-3 mx-5 mb-4">
                                                        <a href="{{ route('front.services.details', $service->slug) }}"
                                                            class="h4 text-white mb-0">{{ $service->title }}</a>
                                                    </div>
                                                    <a class="btn bg-light text-secondary rounded-pill py-3 px-5 mb-4"
                                                        href="{{ route('front.services.details', $service->slug) }}">Explore
                                                        More</a>
                                                </div>
                                                <div class="service-content pb-4">
                                                    <a href="{{ route('front.services.details', $service->slug) }}">
                                                        <h4 class="text-white mb-4 py-3">{{ $service->title }}</h4>
                                                    </a>
                                                    <div class="px-4">
                                                        <p class="mb-4">{!! \Illuminate\Support\Str::limit(strip_tags($service->short_description), 110) !!}</p>
                                                        <a class="btn btn-primary border-secondary rounded-pill py-3 px-5"
                                                            href="{{ route('front.services.details', $service->slug) }}">Explore
                                                            More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- End Services Grid Section -->

    <!-- Start Roadmap Section -->
    @include('front.common._roadmap_section', [
        'page' => $page,
        'sectionContents' => $sectionContents,
        'defaultLabel' => 'Our Development Process',
        'defaultTitle' => \App\Helper::sectionTitle('services', 'roadmap', 'title', 'From Vision to Digital Success'),
        'defaultSubtitle' => \App\Helper::sectionTitle('services', 'roadmap', 'subtitle'),
    ])
    <!-- End Roadmap Section -->

    <!-- Start Testimonials Section -->
    <!-- Testimonials -->
    @include('front.common._testimonials_section', [
        'page' => $page,
        'sectionContents' => $sectionContents,
        'testimonials' => $testimonials,
        'defaultTitle' => \App\Helper::sectionTitle('services', 'testimonials', 'title', 'What Our Clients Say'),
        'defaultSubtitle' => \App\Helper::sectionTitle('services', 'testimonials', 'subtitle'),
    ])
    <!-- End Testimonials Section -->


    <!-- Start CTA Section -->
    <!-- CTA -->
    @include('front.common._cta_section', [
        'page' => $page,
        'sectionContents' => $sectionContents,
        'defaultTitle' => \App\Helper::sectionTitle('services', 'cta', 'title', "LET'S BUILD SOMETHING EXCEPTIONAL"),
        'defaultSubtitle' => \App\Helper::sectionTitle('services', 'cta', 'subtitle'),
    ])
    <!-- End CTA Section -->

    <!-- Start FAQ & Contact Section -->
    @include('front.common._faq_section', [
        'page' => $page,
        'sectionContents' => $sectionContents,
        'category' => $category,
        'defaultTitle' => \App\Helper::sectionTitle('services', 'faq', 'title', 'Frequently Asked Questions'),
        'defaultSubtitle' => \App\Helper::sectionTitle('services', 'faq', 'subtitle'),
    ])
    <!-- End FAQ & Contact Section -->






@endsection
