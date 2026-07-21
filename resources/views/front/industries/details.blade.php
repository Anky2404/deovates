@extends('front.layouts.app')

@section('title', $industry->meta_title ?: $industry->name)
@section('meta_description', $industry->meta_description ?: strip_tags($industry->description))
@section('content')

    <!-- Hero -->
    <!-- Start Hero Section -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ asset('assets/front/img/hero/h1_hero.avif') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>{{ $industry->name }}</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('front.industries.index') }}">Industries</a></li>
                                    <li class="breadcrumb-item active">{{ $industry->name }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Digital Solutions Section -->
    <section class="py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-3 text-center">
                    <div class="simple-process-number mx-auto" style="width:120px;height:120px;font-size:46px;">
                        <i class="{{ $industry->icon ?: 'bx bx-buildings' }}"></i>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="section-title st-start">
                        <h3>Digital Solutions for {{ $industry->name }}</h3>
                    </div>
                    <div class="fs-5 text-muted">{!! $industry->description ?: 'We build secure, scalable, and high-performance digital solutions tailored to the ' . $industry->name . ' industry.' !!}</div>

                    <a href="{{ route('front.contact.index') }}" class="btn btn-main mt-4">Talk to Our Experts</a>
                </div>
            </div>

            @if ($related->isNotEmpty())
                <div class="section-title st-center mt-5">
                    <h3>Other Industries</h3>
                </div>
                <div class="row g-4">
                    @foreach ($related as $item)
                        <div class="col-sm-6 col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                            <a href="{{ route('front.industries.details', $item->slug) }}" class="text-decoration-none">
                                <div class="office-item icon-only h-100">
                                    <div class="office-img">
                                        <i class="{{ $item->icon ?: 'bx bx-buildings' }}"></i>
                                    </div>
                                    <div class="office-content text-center">
                                        <h4>{{ $item->name }}</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
    <!-- End Digital Solutions Section -->

@endsection
