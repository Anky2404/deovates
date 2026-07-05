<header>
    <div class="header-area header-transparent">
        <div class="main-header">

            <div class="header-top d-none d-lg-block">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-between">

                        <div class="header-info-left">
                            <ul>
                                <li>+(123) 1234-567-8901</li>
                                <li>info@domain.com</li>
                                <li>Mon - Sat 8:00 AM - 5:30 PM, Sunday - Closed</li>
                            </ul>
                        </div>

                        <div class="header-info-right">
                            <ul class="header-social">
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <div class="header-bottom header-sticky">
                <div class="container-fluid">

                    <div class="row align-items-center">

                        <div class="col-xl-2 col-lg-2 col-md-2">
                            <div class="logo">

                                <a href="{{ url('/') }}" class="big-logo">
                                    <img src="{{ asset('assets/front/img/logo/logo.png') }}" alt="Logo">
                                </a>

                                <a href="{{ url('/') }}" class="small-logo">
                                    <img src="{{ asset('assets/front/img/logo/loder-logo.png') }}" alt="Logo">
                                </a>

                            </div>
                        </div>

                        <div class="col-xl-8 col-lg-8 col-md-8">

                            <div class="main-menu f-right d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">

                                        <li>
                                            <a href="{{ route('front.home.index') }}" class="{{ request()->routeIs('front.home.index') ? 'active' : '' }}">
                                                Home
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('front.about.index') }}" class="{{ request()->routeIs('front.about.index') ? 'active' : '' }}">
                                                About
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('front.projects.index') }}" class="{{ request()->routeIs('front.projects.index') ? 'active' : '' }}">
                                                Projects
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('front.services.index') }}" class="{{ request()->routeIs('front.services.index') ? 'active' : '' }}">
                                                Services
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('front.blog.index') }}" class="{{ request()->routeIs('blog*') ? 'active' : '' }}">
                                                Blog
                                            </a>

                                            <ul class="submenu">
                                                <li>
                                                    <a href="{{ route('front.blog.index') }}">Blog</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('front.blog.details') }}">Blog Details</a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li>
                                            <a href="#">Pages</a>

                                            <ul class="submenu">
                                                <li>
                                                    <a href="{{ route('front.elements.index') }}">Elements</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('front.project.details') }}">Project Details</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('front.service.details') }}">Service Details</a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li>
                                            <a href="{{ route('front.contact.index') }}" class="{{ request()->routeIs('front.contact.index') ? 'active' : '' }}">
                                                Contact
                                            </a>
                                        </li>

                                    </ul>
                                </nav>
                            </div>

                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2">
                            <div class="header-right-btn f-right d-none d-lg-block">
                                <a href="{{ route('front.contact.index') }}" class="btn">
                                    Contact Now
                                </a>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</header>
