@extends('front.layouts.app')

@section('title', 'Client Testimonials')
@section('content')

    <!-- Hero -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ \App\Helper::heroBanner('testimonials.jpg', 'assets/front/img/hero/h2_hero.png') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>Client Testimonials</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Testimonials</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($testimonials->isEmpty())
        <section class="py-5">
            <div class="container py-5 text-center text-muted">Testimonials will be shown here shortly.</div>
        </section>
    @else
        <section class="testimonials py-5">
            <div class="container py-5">
                <div class="section-title st-center">
                    <h3>What Our Clients Say</h3>
                    <p>Real feedback from the businesses we've partnered with.</p>
                </div>

                <div class="testi-mockup mx-auto">
                    <div class="laptop-shine"></div>
                    <div class="testi-glass">
                        <div class="testimonials-carousel owl-carousel">
                            @foreach ($testimonials as $testimonial)
                                <div class="testimonial">
                                    <blockquote>
                                        <p>&ldquo;{{ $testimonial->message }}&rdquo;</p>
                                        <footer>
                                            <img src="{{ \App\Helper::img($testimonial->photo) }}"
                                                alt="{{ $testimonial->name }}">
                                            <div>
                                                <strong>{{ $testimonial->name }}</strong>
                                                <span>{{ $testimonial->designation }}{{ $testimonial->company ? ', ' . $testimonial->company : '' }}</span>
                                            </div>
                                        </footer>
                                    </blockquote>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5" style="background:#f5f8fd;">
            <div class="container py-5">
                <div class="row g-4">
                    @foreach ($testimonials as $testimonial)
                        <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="p-4 rounded-4 h-100" style="background:#fff;box-shadow:0 10px 30px rgba(11,28,57,.08);">
                                @if ($testimonial->rating)
                                    <div class="mb-2" style="color:#f85603;">
                                        @for ($i = 0; $i < $testimonial->rating; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                    </div>
                                @endif
                                <p class="text-muted fst-italic">&ldquo;{{ $testimonial->message }}&rdquo;</p>
                                <div class="d-flex align-items-center gap-3 mt-3">
                                    <img src="{{ \App\Helper::img($testimonial->photo) }}"
                                        alt="{{ $testimonial->name }}"
                                        style="width:48px;height:48px;border-radius:50%;object-fit:cover;">
                                    <div>
                                        <strong style="color:#073965;">{{ $testimonial->name }}</strong>
                                        <div class="small text-muted">{{ $testimonial->designation }}{{ $testimonial->company ? ', ' . $testimonial->company : '' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection
