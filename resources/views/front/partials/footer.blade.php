<footer>
    <div class="footer-main">
        <div class="footer-area footer-padding">
            <div class="container">

                <div class="row justify-content-between">

                    <div class="col-lg-4 col-md-4 col-sm-8">
                        <div class="single-footer-caption mb-30">

                            <div class="footer-logo">
                                <a href="{{ route('front.home.index') }}">
                                    <img src="{{ asset('assets/front/img/logo/logo2_footer.png') }}" alt="Footer Logo">
                                </a>
                            </div>

                            <div class="footer-tittle">
                                <div class="footer-pera">
                                    <p class="info1">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-5">
                        <div class="single-footer-caption mb-50">

                            <div class="footer-tittle">
                                <h4>Quick Links</h4>

                                <ul>
                                    <li><a href="{{ route('front.about.index') }}">About</a></li>
                                    <li><a href="{{ route('front.services.index') }}">Services</a></li>
                                    <li><a href="{{ route('front.projects.index') }}">Projects</a></li>
                                    <li><a href="{{ route('front.contact.index') }}">Contact Us</a></li>
                                </ul>

                            </div>

                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-7">
                        <div class="single-footer-caption mb-50">

                            <div class="footer-tittle">

                                <h4>Contact</h4>

                                <div class="footer-pera">
                                    <p class="info1">
                                        198 West 21th Street, Suite 721, New York, NY 10010
                                    </p>
                                </div>

                                <ul>
                                    <li><a href="tel:+950123456789">Phone: +95 (0) 123 456 789</a></li>
                                    <li><a href="tel:+950123456789">Cell: +95 (0) 123 456 789</a></li>
                                </ul>

                            </div>

                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-8">
                        <div class="single-footer-caption mb-50">

                            <div class="footer-form">

                                <div id="mc_embed_signup">

                                    <form target="_blank"
                                        action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                                        method="get"
                                        class="subscribe_form relative mail_part"
                                        novalidate>

                                        <input
                                            type="email"
                                            name="EMAIL"
                                            id="newsletter-form-email"
                                            placeholder="Email Address"
                                            class="placeholder hide-on-focus"
                                            onfocus="this.placeholder=''"
                                            onblur="this.placeholder='Email Address'">

                                        <div class="form-icon">
                                            <button
                                                type="submit"
                                                id="newsletter-submit"
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

                        </div>
                    </div>

                </div>

                <div class="row align-items-center">

                    <div class="col-xl-12">

                        <div class="footer-copy-right">
                            <p>
                                Copyright &copy; {{ date('Y') }}
                                All Rights Reserved.
                            </p>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</footer>
