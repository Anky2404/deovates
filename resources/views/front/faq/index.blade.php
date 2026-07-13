@extends('front.layouts.app')

@section('title', 'Frequently Asked Questions')
@section('content')

    <!-- Hero -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ \App\Helper::heroBanner('faq.jpg', 'assets/front/img/hero/h2_hero.png') }}">
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

    <section class="py-5">
        <div class="container py-5">
            <div class="section-title st-center">
                <h3>Have Questions?</h3>
                <p>Answers to the questions we hear most often about working with Deovate World.</p>
            </div>

            @forelse ($faqs as $faq)
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <div class="faq-item {{ $loop->first ? 'active' : '' }}">
                            <div class="faq-title">
                                <h5>{{ $faq['question'] }}</h5>
                                <div class="faq-icon"><i class="fas fa-plus"></i></div>
                            </div>
                            <div class="faq-content" style="{{ $loop->first ? 'display:block;' : '' }}">
                                <p>{{ $faq['answer'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">FAQs will be listed here shortly.</p>
            @endforelse

            <div class="text-center mt-5">
                <p class="text-muted mb-3">Still have a question?</p>
                <a href="{{ route('front.contact.index') }}" class="btn btn-main">Contact Us</a>
            </div>
        </div>
    </section>

@endsection
