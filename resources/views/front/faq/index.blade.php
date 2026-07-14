@extends('front.layouts.app')

@section('title', 'Frequently Asked Questions')
@section('content')

    <!-- Hero -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ \App\Helper::heroBanner('faq.png', 'assets/front/img/hero/h2_hero.png') }}">
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

   <!-- Testimonials -->
    <section class="testimonials">

        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center">
                        <h3>Industries</h3>
                        <p>Avocent deditum long</p>
                    </div>
                </div>
            </div>

            <div class="testi-mockup wow fadeInUp" data-wow-delay="0.1s">
                <div class="laptop-screen">
                    <div class="laptop-browser-bar">
                        <span class="dot dot-red"></span>
                        <span class="dot dot-yellow"></span>
                        <span class="dot dot-green"></span>
                        <span class="laptop-url">deovate.world/reviews</span>
                    </div>
                    <div class="laptop-screen-glass testi-glass">
                        <div class="laptop-shine"></div>
                        <div class="testimonials-carousel owl-carousel owl-theme">

                            <!-- Testimonial 1 -->
                            <div class="testimonial">
                                <div class="testimonial-img">
                                    <img src="{{ asset('assets/front/img/testimonial/Homepage_testi.png') }}"
                                        alt="John Anderson">
                                </div>
                                <blockquote>
                                    <p>
                                        Their team delivered our website ahead of schedule with
                                        exceptional quality. Communication was excellent and
                                        the final product exceeded our expectations.
                                    </p>
                                    <footer>
                                        <strong>John Anderson</strong><br>
                                        <cite>CEO, Tech Solutions</cite>
                                    </footer>
                                </blockquote>
                            </div>

                            <!-- Testimonial 2 -->
                            <div class="testimonial">
                                <div class="testimonial-img">
                                    <img src="{{ asset('assets/front/img/testimonial/1.png') }}" alt="Sarah Williams">
                                </div>
                                <blockquote>
                                    <p>
                                        Professional developers with deep technical knowledge.
                                        They successfully developed our ERP system and continue
                                        to provide outstanding support.
                                    </p>
                                    <footer>
                                        <strong>Sarah Williams</strong><br>
                                        <cite>Operations Manager</cite>
                                    </footer>
                                </blockquote>
                            </div>

                            <!-- Testimonial 3 -->
                            <div class="testimonial">
                                <div class="testimonial-img">
                                    <img src="{{ asset('assets/front/img/testimonial/Homepage_testi.png') }}"
                                        alt="Michael Brown">
                                </div>
                                <blockquote>
                                    <p>
                                        We highly recommend them for custom software development.
                                        Our online sales increased significantly after launching
                                        the new platform.
                                    </p>
                                    <footer>
                                        <strong>Michael Brown</strong><br>
                                        <cite>Founder, Ecommerce Hub</cite>
                                    </footer>
                                </blockquote>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="laptop-base">
                    <span class="laptop-notch"></span>
                </div>
                <div class="laptop-shadow"></div>
            </div>

        </div>

    </section>



    <!-- CTA -->
    <section class="call-2-acction" data-stellar-background-ratio="0.4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="section-title st-center">
                        <h3>LET'S BUILD SOMETHING EXCEPTIONAL</h3>

                        <p>
                            Transform Your Vision into Powerful Digital Solutions
                        </p>
                    </div>

                    <div class="c2a">

                        <p>
                            Whether you're launching a startup, modernizing your business, or scaling your digital presence,
                            Deovate World delivers custom websites, business software, eCommerce platforms, and innovative
                            technology solutions tailored to your goals. Partner with our experienced team to build secure,
                            scalable, and high-performing digital products that create lasting business value.
                        </p>

                        <a href="{{ route('front.contact.index') }}" class="btn btn-main btn-lg">
                            Start Your Project
                        </a>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <section id="faq-section" class="faq-section">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center">
                        <h3>Industries</h3>
                        <p>Avocent deditum long</p>
                    </div>
                </div>
            </div>

            <div class="faq-contact-grid">

                <!-- LEFT: FAQ app tablet -->
                <div class="faq-tablet-col wow fadeInLeft" data-wow-delay="0.1s">
                    <div class="app-tablet">
                        <div class="tablet-frame app-tablet-frame">
                            <div class="tablet-cam"></div>
                            <div class="tablet-screen app-tablet-screen">
                                <div class="tablet-statusbar">
                                    <span class="phone-brand">Deovate</span>
                                </div>

                                <div class="app-screen-header">
                                    <h4>FAQs</h4>
                                    <p>Quick answers to common questions</p>
                                </div>

                                <div class="faq-wrapper app-faq-list">

                                    <div class="faq-item active">
                                        <div class="faq-title">
                                            <h5>What services does your company provide?</h5>
                                            <span class="faq-icon">
                                                <i class="fa fa-minus"></i>
                                            </span>
                                        </div>

                                        <div class="faq-content" style="display:block;">
                                            <p>
                                                We provide website development, custom software development,
                                                eCommerce solutions, mobile applications, UI/UX design,
                                                cloud solutions, API integration, ERP/CRM systems, and
                                                ongoing maintenance & support.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="faq-item">
                                        <div class="faq-title">
                                            <h5>How long does a website or software project take?</h5>
                                            <span class="faq-icon">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                        </div>

                                        <div class="faq-content">
                                            <p>
                                                Project timelines depend on complexity. A business website
                                                generally takes 2–4 weeks, while custom software or enterprise
                                                applications may take several weeks to a few months.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="faq-item">
                                        <div class="faq-title">
                                            <h5>Do you provide website redesign services?</h5>
                                            <span class="faq-icon">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                        </div>

                                        <div class="faq-content">
                                            <p>
                                                Yes. We redesign outdated websites with a modern UI,
                                                better performance, improved SEO, enhanced security,
                                                and a fully responsive design.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="faq-item">
                                        <div class="faq-title">
                                            <h5>Which technologies do you specialize in?</h5>
                                            <span class="faq-icon">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                        </div>

                                        <div class="faq-content">
                                            <p>
                                                We work with Laravel, PHP, React, Node.js, Java, Spring Boot,
                                                MySQL, PostgreSQL, WordPress, Shopify, REST APIs,
                                                AWS, Azure and modern frontend technologies.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="faq-item">
                                        <div class="faq-title">
                                            <h5>Will my website be mobile-friendly?</h5>
                                            <span class="faq-icon">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                        </div>

                                        <div class="faq-content">
                                            <p>
                                                Absolutely. Every website we build is fully responsive
                                                and optimized for desktops, tablets and smartphones.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="faq-item">
                                        <div class="faq-title">
                                            <h5>Do you provide maintenance after project delivery?</h5>
                                            <span class="faq-icon">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                        </div>

                                        <div class="faq-content">
                                            <p>
                                                Yes. We provide maintenance, security updates,
                                                bug fixes, performance optimization and technical
                                                support after deployment.
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="tablet-home-btn"></div>
                        </div>
                        <div class="tablet-shadow"></div>
                    </div>
                </div>

                <!-- RIGHT: Contact form tablet -->
                <div class="contact-tablet-col wow fadeInRight" data-wow-delay="0.2s">
                    <div class="app-tablet">
                        <div class="tablet-frame app-tablet-frame">
                            <div class="tablet-cam"></div>
                            <div class="tablet-screen app-tablet-screen">
                                <div class="tablet-statusbar">
                                    <span class="phone-brand">Deovate</span>
                                </div>

                                <div class="app-screen-header">
                                    <h4>Get In Touch</h4>
                                    <p>We'd love to hear about your project</p>
                                </div>

                                <form id="homeContactForm" class="app-contact-form" novalidate>

                                    <div class="app-form-group">
                                        <label for="hc-name">Full Name</label>
                                        <input type="text" id="hc-name" name="name" required
                                            placeholder="John Doe">
                                        <span class="app-form-error">Please enter your name.</span>
                                    </div>

                                    <div class="app-form-group">
                                        <label for="hc-email">Email Address</label>
                                        <input type="email" id="hc-email" name="email" required
                                            placeholder="john@example.com">
                                        <span class="app-form-error">Please enter a valid email.</span>
                                    </div>

                                    <div class="app-form-group">
                                        <label for="hc-phone">Phone Number</label>
                                        <input type="tel" id="hc-phone" name="phone"
                                            placeholder="+91 12345 67890">
                                        <span class="app-form-error">Please enter a valid phone number.</span>
                                    </div>

                                    <div class="app-form-group">
                                        <label for="hc-message">Message</label>
                                        <textarea id="hc-message" name="message" rows="4" required placeholder="Tell us about your project..."></textarea>
                                        <span class="app-form-error">Please enter a message.</span>
                                    </div>

                                    <button type="submit" class="app-form-submit">
                                        <span class="app-form-submit-text">Send Message</span>
                                        <span class="app-form-submit-loader"></span>
                                    </button>

                                    <div class="app-form-success">
                                        <i class="fa fa-check-circle"></i>
                                        <p>Thanks! Your message has been noted.</p>
                                    </div>

                                </form>
                            </div>
                            <div class="tablet-home-btn"></div>
                        </div>
                        <div class="tablet-shadow"></div>
                    </div>
                </div>

            </div>

        </div>
    </section>


@endsection
