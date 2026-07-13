@extends('front.layouts.app')

@section('title', $data['hero']['title'] ?? 'Contact Us')
@section('content')

    <!-- Hero -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ \App\Helper::heroBanner('contact.jpg', 'assets/front/img/banner/contact_bg.png') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>{{ $data['hero']['title'] }}</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Contact</li>
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
            <div class="row g-5 justify-content-center">
                <div class="col-lg-7">
                    <div class="section-title st-start">
                        <h3>{{ $data['contact_form']['title'] }}</h3>
                        <p>{{ $data['contact_form']['description'] }}</p>
                    </div>

                    <!-- Desktop: form inside a tablet iframe -->
                    <div class="app-tablet contact-form-tablet d-none d-lg-block wow fadeInLeft" data-wow-delay="0.1s">
                        <div class="tablet-frame app-tablet-frame">
                            <div class="tablet-cam"></div>
                            <div class="tablet-screen app-tablet-screen">
                                <div class="tablet-statusbar">
                                    <span class="phone-brand">Deovate</span>
                                </div>
                                <div class="app-screen-header">
                                    <h4>Contact Form</h4>
                                    <p>www.deovateworld.com/contact</p>
                                </div>
                                @include('front.contact._form-fields', ['prefix' => 'mc'])
                            </div>
                        </div>
                    </div>

                    <!-- Mobile: form inside a phone iframe -->
                    <div class="phone-mockup contact-form-phone d-lg-none wow fadeInUp" data-wow-delay="0.1s"
                        style="max-width:340px;">
                        <div class="phone-frame">
                            <div class="phone-notch"></div>
                            <div class="phone-screen">
                                <div class="phone-statusbar">
                                    <span class="phone-brand">Deovate</span>
                                </div>
                                <div class="app-screen-header">
                                    <h4>Contact Form</h4>
                                    <p>www.deovateworld.com/contact</p>
                                </div>
                                @include('front.contact._form-fields', ['prefix' => 'mcm'])
                            </div>
                            <div class="phone-home-indicator"></div>
                        </div>
                        <div class="phone-shadow"></div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="section-title st-start">
                        <h3>{{ $data['contact_details']['title'] }}</h3>
                    </div>

                    <!-- Contact details styled as a mobile app -->
                    <div class="phone-mockup contact-info-phone wow fadeInRight" data-wow-delay="0.15s">
                        <div class="phone-frame">
                            <div class="phone-notch"></div>
                            <div class="phone-screen">
                                <div class="phone-statusbar">
                                    <span class="phone-brand">Deovate</span>
                                </div>
                                <div class="contact-info-app">
                                    <ul class="list-unstyled mb-3">
                                        @foreach ($data['contact_details']['intro_lines'] ?? [] as $line)
                                            <li><i class="fas fa-check-circle"></i>{{ $line }}</li>
                                        @endforeach
                                    </ul>

                                    <a href="tel:{{ config('constants.CONTACT.country_code') }}{{ config('constants.CONTACT.phones.0.number') }}"
                                        class="contact-info-card">
                                        <span class="contact-info-icon"><i class="fas fa-phone-alt"></i></span>
                                        <span>
                                            <span class="contact-info-label">Call Us</span>
                                            <span class="contact-info-value">{{ config('constants.CONTACT.country_code') }}-{{ config('constants.CONTACT.phones.0.number') }}</span>
                                        </span>
                                    </a>

                                    <a href="mailto:{{ config('constants.CONTACT.emails.0.address') }}"
                                        class="contact-info-card">
                                        <span class="contact-info-icon"><i class="fas fa-envelope"></i></span>
                                        <span>
                                            <span class="contact-info-label">Email Us</span>
                                            <span class="contact-info-value">{{ config('constants.CONTACT.emails.0.address') }}</span>
                                        </span>
                                    </a>

                                    <div class="contact-info-card">
                                        <span class="contact-info-icon"><i class="fas fa-map-marker-alt"></i></span>
                                        <span>
                                            <span class="contact-info-label">Location</span>
                                            <span class="contact-info-value">{{ $data['contact_details']['location'] ?? 'Ludhiana, Punjab, India' }}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="phone-home-indicator"></div>
                        </div>
                        <div class="phone-shadow"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (!empty($data['process']['steps']))
        <section class="py-5" style="background:#f5f8fd;">
            <div class="container py-5">
                <div class="section-title st-center">
                    <h3>{{ $data['process']['title'] }}</h3>
                    <p>{{ $data['process']['subtitle'] }}</p>
                </div>

                <div class="row g-4">
                    @foreach ($data['process']['steps'] as $step)
                        <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="{{ 0.1 * $loop->iteration }}s">
                            <div class="simple-process-item">
                                <div class="simple-process-number">{{ $step['step'] }}</div>
                                <h4>{{ $step['title'] }}</h4>
                                <p>{{ $step['description'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (!empty($data['map_section']['iframe_url']))
        <section class="py-5">
            <div class="container py-5">
                <div class="section-title st-center">
                    <h3>{{ $data['map_section']['title'] }}</h3>
                    <p>{{ $data['map_section']['subtitle'] }}</p>
                </div>

                <!-- Desktop: map inside a laptop/browser frame -->
                <div class="laptop-mockup d-none d-lg-block wow fadeInUp" data-wow-delay="0.1s">
                    <div class="laptop-screen">
                        <div class="laptop-browser-bar">
                            <span class="dot dot-red"></span>
                            <span class="dot dot-yellow"></span>
                            <span class="dot dot-green"></span>
                            <span class="laptop-url">maps.deovate.world/office-location</span>
                        </div>
                        <div class="laptop-screen-glass">
                            <div class="laptop-shine"></div>
                            <iframe src="{{ $data['map_section']['iframe_url'] }}" width="100%" height="420"
                                style="border:0; position:relative; display:block;" allowfullscreen loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="laptop-base">
                        <span class="laptop-notch"></span>
                    </div>
                    <div class="laptop-shadow"></div>
                </div>

                <!-- Mobile: map inside a phone frame -->
                <div class="phone-mockup d-lg-none wow fadeInUp" data-wow-delay="0.1s" style="max-width:320px;">
                    <div class="phone-frame">
                        <div class="phone-notch"></div>
                        <div class="phone-screen">
                            <div class="phone-statusbar">
                                <span class="phone-brand">Deovate Maps</span>
                            </div>
                            <iframe src="{{ $data['map_section']['iframe_url'] }}" width="100%" height="420"
                                style="border:0; display:block;" allowfullscreen loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <div class="phone-home-indicator"></div>
                    </div>
                    <div class="phone-shadow"></div>
                </div>
            </div>
        </section>
    @endif

@endsection
