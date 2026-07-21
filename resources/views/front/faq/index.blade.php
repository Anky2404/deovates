@extends('front.layouts.app')

@section('title', config('constants.PAGE_SEO.faq.title'))
@section('meta_description', config('constants.PAGE_SEO.faq.meta_description'))
@section('meta_keywords', config('constants.PAGE_SEO.faq.meta_keywords'))
@section('content')

    <!-- Start Hero Section -->
    <!-- Hero -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ \App\Helper::heroBanner('faq.avif', 'assets/front/img/hero/h2_hero.avif') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>Frequently Asked Questions</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active">FAQ</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Client Testimonials Section -->
   <!-- Testimonials -->
    @include('front.partials._testimonials_section', [
        'page' => $page,
        'sectionContents' => $sectionContents,
        'testimonials' => $testimonials,
        'defaultTitle' => \App\Helper::sectionTitle('faq', 'testimonials', 'title', 'What Our Clients Say'),
        'defaultSubtitle' => \App\Helper::sectionTitle('faq', 'testimonials', 'subtitle'),
    ])
    <!-- End Client Testimonials Section -->



    <!-- Start CTA Section -->
    <!-- CTA -->
    @include('front.partials._cta_section', [
        'page' => $page,
        'sectionContents' => $sectionContents,
        'defaultTitle' => \App\Helper::sectionTitle('faq', 'cta', 'title', "LET'S BUILD SOMETHING EXCEPTIONAL"),
        'defaultSubtitle' => \App\Helper::sectionTitle('faq', 'cta', 'subtitle'),
    ])
    <!-- End CTA Section -->

    <!-- Start FAQ Section -->
    @include('front.partials._faq_section', [
        'page' => $page,
        'sectionContents' => $sectionContents,
        'category' => $category,
        'defaultTitle' => \App\Helper::sectionTitle('faq', 'faq', 'title', 'Frequently Asked Questions'),
        'defaultSubtitle' => \App\Helper::sectionTitle('faq', 'faq', 'subtitle'),
    ])
    <!-- End FAQ Section -->


@endsection
