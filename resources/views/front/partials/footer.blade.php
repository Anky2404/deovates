<!-- Start Footer Section -->
<footer>
    <div class="footer-main">
        <div class="footer-area footer-padding">
            <div class="container">

                <div class="row justify-content-between">

                    <div class="col-lg-3 col-md-4 col-sm-8">
                        <div class="single-footer-caption mb-30">

                            <div class="footer-logo">
                                <a href="{{ route('front.home.index') }}">
                                    <img src="{{ asset(config('constants.CONFIG.logo.header')) }}"
                                        alt="{{ config('constants.BUSINESS.name') }}">
                                </a>
                            </div>

                            <div class="footer-tittle">
                                <div class="footer-pera">
                                    <p class="info1">
                                        {{ config('constants.CONFIG.footer_info') }}
                                    </p>
                                </div>
                            </div>

                        </div>
                         @php
                                $googleRatingFooter = \App\Models\SiteSetting::get('google_reviews_average_rating');
                                $googleTotalFooter = \App\Models\SiteSetting::get('google_reviews_total_count');
                            @endphp

                            @if ($googleRatingFooter && $googleTotalFooter)
                                <a href="{{ route('front.testimonials.index') }}" class="site-visitor-counter google-rating-counter">
                                    <span class="site-visitor-counter-icon google-rating-counter-icon">
                                        <i class="bx bxs-star"></i>
                                    </span>
                                    <span class="site-visitor-counter-text">
                                        <strong class="site-visitor-counter-number">{{ number_format($googleRatingFooter, 1) }}</strong>
                                        <span class="site-visitor-counter-label">{{ number_format($googleTotalFooter) }} Google Reviews</span>
                                    </span>
                                </a>
                            @endif
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-5">
                        <div class="single-footer-caption mb-50">

                            <div class="footer-tittle">
                                <h4>Quick Links</h4>

                                <ul>
                                    <li><a href="{{ route('front.about.index') }}">About</a></li>
                                    <li><a href="{{ route('front.services.index') }}">Services</a></li>
                                    <li><a href="{{ route('front.portfolios.index') }}">Projects</a></li>
                                    <li><a href="{{ route('front.industries.index') }}">Industries</a></li>
                                    <li><a href="{{ route('front.casestudies.index') }}">Case Studies</a></li>
                                    <li><a href="{{ route('front.blog.index') }}">Blog</a></li>
                                    <li><a href="{{ route('front.contact.index') }}">Contact Us</a></li>
                                </ul>

                            </div>

                        </div>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-5">
                        <div class="single-footer-caption mb-50">

                            <div class="footer-tittle">
                                <h4>Resources</h4>

                                <ul>
                                    <li><a href="{{ route('front.career.index') }}">Careers</a></li>
                                    <li><a href="{{ route('front.testimonials.index') }}">Testimonials</a></li>
                                    <li><a href="{{ route('front.techstack.index') }}">Tech Stack</a></li>
                                    <li><a href="{{ route('front.alliances.index') }}">Alliances</a></li>
                                    <li><a href="{{ route('front.pricing.index') }}">Pricing</a></li>
                                    <li><a href="{{ route('front.faq.index') }}">FAQ</a></li>
                                </ul>

                            </div>

                        </div>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-7">
                        <div class="single-footer-caption mb-50">

                            <div class="footer-tittle">

                                <h4>Contact</h4>

                                <div class="footer-pera">
                                    <p class="info1">
                                        {{ config('constants.ADDRESS.return_address') }}
                                    </p>
                                </div>

                                <ul>
                                    <li><a href="tel:{{ config('constants.CONTACT.country_code') }}{{ config('constants.CONTACT.phones.0.number') }}">Phone: {{ config('constants.CONTACT.country_code') }}-{{ config('constants.CONTACT.phones.0.number') }}</a></li>
                                    <li><a href="tel:{{ config('constants.CONTACT.country_code') }}{{ config('constants.CONTACT.phones.1.number') }}">Cell: {{ config('constants.CONTACT.country_code') }}-{{ config('constants.CONTACT.phones.1.number') }}</a></li>
                                    <li><a href="{{ route('front.legal.privacy') }}">Privacy Policy</a></li>
                                    <li><a href="{{ route('front.legal.terms') }}">Terms &amp; Conditions</a></li>
                                </ul>

                            </div>

                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-8">
                        <div class="single-footer-caption mb-50">

                            <div class="footer-form">

                                <div id="mc_embed_signup">

                                    <form method="POST" action="{{ route('front.newsletter.subscribe') }}"
                                        class="subscribe_form app-newsletter-form relative mail_part" novalidate>
                                        @csrf

                                        <input type="email" name="email" id="newsletter-form-email"
                                            placeholder="Email Address" class="placeholder hide-on-focus"
                                            onfocus="this.placeholder=''" onblur="this.placeholder='Email Address'"
                                            required>

                                        <div class="form-icon">
                                            <button type="submit" id="newsletter-submit"
                                                class="email_icon newsletter-submit button-contactForm">
                                                SIGN UP
                                            </button>
                                        </div>

                                        <div class="mt-10 info"></div>

                                    </form>

                                </div>

                            </div>

                            <div class="map-footer">
                                <img src="{{ asset('assets/front/img/gallery/map-footer.png') }}" alt="Map">
                            </div>

                            <div class="site-visitor-counter" data-count="{{ \App\Models\SiteVisit::count() }}">
                                <span class="site-visitor-counter-icon">
                                    <i class="bx bx-group"></i>
                                </span>
                                <span class="site-visitor-counter-text">
                                    <strong class="site-visitor-counter-number">0</strong>
                                    <span class="site-visitor-counter-label">Total Visitors</span>
                                </span>
                            </div>

                           

                        </div>
                    </div>

                </div>

                <div class="row align-items-center">

                    <div class="col-xl-12">

                        <div class="footer-copy-right text-center">
                            <p>
                                Copyright &copy; {{ date('Y') }}
                                <a href="{{ route(config('constants.HEADERS.0.route')) }}"
                                    class="text-decoration-none">{{ config('constants.BUSINESS.name') }}</a>.
                                All Rights Reserved.
                            </p>
                        </div>

                    </div>

                </div>

              
            </div>
        </div>
    </div>
</footer>
<!-- End Footer Section -->
