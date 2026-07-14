@extends('front.layouts.app')

@section('title', 'Our Alliances & Partners')
@section('content')

    <!-- Hero -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ \App\Helper::heroBanner('alliances.png', 'assets/front/img/hero/h2_hero.png') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>Alliances &amp; Partners</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Alliances</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="py-5">
        <div class="container py-5">
            <div class="section-title st-center">
                <h3>Businesses We Work With</h3>
                <p>Trusted partnerships that help us deliver more value to every client we serve.</p>
            </div>

            @if ($partners->isEmpty())
                <p class="text-center text-muted">Partners will be listed here shortly.</p>
            @else
                <div class="row g-4">
                    @foreach ($partners as $partner)
                        <div class="col-6 col-sm-4 col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                            <a href="{{ $partner->website_url ?: '#' }}"
                                target="{{ $partner->website_url ? '_blank' : '_self' }}" rel="noopener noreferrer"
                                class="d-flex align-items-center justify-content-center text-center p-4 rounded-4 h-100 text-decoration-none"
                                style="background:#fff;border:1px solid #e3e8f0;min-height:140px;">
                                <div>
                                    <img src="{{ \App\Helper::img($partner->logo) }}" alt="{{ $partner->name }}"
                                        class="img-fluid mb-2" style="max-height:60px;">
                                    <div class="small" style="color:#073965;font-weight:600;">{{ $partner->name }}</div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

@endsection
