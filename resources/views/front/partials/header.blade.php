<header>
    <div class="header-area header-transparent">
        <div class="main-header">

            <div class="header-top d-none d-lg-block">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-between">

                        <div class="header-info-left">
                            <ul>
                                <li>
                                    {{ config('constants.CONTACT.country_code') }}-{{ config('constants.CONTACT.phones.0.number') }}
                                </li>
                                <li>
                                    {{ config('constants.CONTACT.emails.0.address') }}
                                </li>
                                {{-- <li>
                                    Mon - Sat {{ config('constants.BUSINESS.timings_weekdays') }},
                                    Sunday - {{ config('constants.BUSINESS.timings_weekend') }}
                                </li> --}}
                            </ul>
                        </div>

                        <div class="header-info-right">
                            <ul class="header-social">
                                @foreach (config('constants.SOCIAL_LINKS') as $social)
                                    <li>
                                        <a href="{{ $social['link'] }}" target="_blank" rel="noopener noreferrer">
                                            <i class="{{ $social['icon'] }}"></i>
                                        </a>
                                    </li>
                                @endforeach
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
                                <a href="{{ route(config('constants.HEADERS.0.route')) }}" class="big-logo">
                                    <img src="{{ asset(config('constants.CONFIG.light_logo')) }}"
                                        alt="{{ config('constants.BUSINESS.name') }}">
                                </a>

                                <a href="{{ route(config('constants.HEADERS.0.route')) }}" class="small-logo">
                                    <img src="{{ asset(config('constants.CONFIG.dark_logo')) }}"
                                        alt="{{ config('constants.BUSINESS.name') }}">
                                </a>
                            </div>
                        </div>

                        <div class="col-xl-8 col-lg-8 col-md-8">

                            <div class="main-menu f-right d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        @foreach (config('constants.HEADERS') as $menu)
                                            <li>
                                                <a href="{{ route($menu['route']) }}"
                                                    class="{{ request()->routeIs($menu['route']) ? 'active' : '' }}">
                                                    {{ $menu['title'] }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </nav>
                            </div>

                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2">
                            <div class="header-right-btn f-right d-none d-lg-block">
                                <a href="{{ config('constants.CONTACT.whatsapp.link') }}" class="btn"
                                    target="_blank" rel="noopener noreferrer">
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
