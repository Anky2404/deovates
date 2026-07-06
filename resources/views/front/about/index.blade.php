@extends('front.layouts.app')
@section('content')
    <!-- slider Area Start-->
    <div class="slider-area ">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ asset('assets/front/img/hero/about.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>About us</h2>
                            <nav aria-label="breadcrumb ">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Product</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->
    <!-- About Area Start -->
    <section class="about" id="about">
        <div class="container-xxl py-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title st-center">
                        <h3>WelCome to Sept</h3>
                        <p>We are a creative Designer</p>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s"
                        style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                        <div class="img-border">
                            <img class="img-fluid" src="{{ asset('assets/front/img/about_1.jpg') }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s"
                        style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                        <div class="h-100">

                            <h1 class="display-6 mb-4">#1 Digital Solution With <span class="text-primary">10 Years</span>
                                Of Experience</h1>
                            <p>Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos.
                                Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet
                            </p>
                            <p class="mb-4">Stet no et lorem dolor et diam, amet duo ut dolore vero eos. No stet est diam
                                rebum amet diam ipsum. Clita clita labore, dolor duo nonumy clita sit at, sed sit sanctus
                                dolor eos.</p>
                            <div class="d-flex align-items-center mb-4 pb-2">

                                <img class="flex-shrink-0 rounded-circle" src="{{ asset('assets/front/img/team-1.jpg') }}"
                                    alt="" style="width:60px;height:60px;object-fit:cover;">

                                <div class="ps-3">

                                    <h4 class="signature mb-1">
                                        Anky Singh Humraj
                                    </h4>

                                    <small>CEO & Founder</small>

                                </div>

                            </div>
                            {{-- <a class="btn btn-primary rounded-pill py-3 px-5" href="">Read More</a> --}}
                        </div>
                    </div>
                </div>
                <div class="row g-5 mt-50">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s"
                        style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                        <div class="h-100">

                            <h1 class="display-6 mb-4">Why People Trust Us? Learn About Us!</h1>
                            <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet
                                diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna
                                dolore erat amet</p>
                            <div class="row g-4">
                                <div class="col-12">
                                    <div class="skill">
                                        <div class="d-flex justify-content-between">
                                            <p class="mb-2">Digital Marketing</p>
                                            <p class="mb-2">85%</p>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="85"
                                                aria-valuemin="0" aria-valuemax="100" style="width: 85%;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="skill">
                                        <div class="d-flex justify-content-between">
                                            <p class="mb-2">SEO &amp; Backlinks</p>
                                            <p class="mb-2">90%</p>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="90"
                                                aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="skill">
                                        <div class="d-flex justify-content-between">
                                            <p class="mb-2">Design &amp; Development</p>
                                            <p class="mb-2">95%</p>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="95"
                                                aria-valuemin="0" aria-valuemax="100" style="width: 95%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s"
                        style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                        <div class="img-border">
                            <img class="img-fluid" src="{{ asset('assets/front/img/feature.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- Team End -->

    <section class="clients py-5 bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center">
                        <h3>Some Of Our Clients</h3>
                        <p>Avocent deditum long</p>
                    </div>
                </div>
            </div>
            <div class="clients-carousel owl-carousel owl-theme">
                <div class="item">
                    <img src="{{ asset('assets/front/img/client.png') }}" class="img-fluid" alt="Client 1">
                </div>
                <div class="item">
                    <img src="{{ asset('assets/front/img/client2.png') }}" class="img-fluid" alt="Client 2">
                </div>
                <div class="item">
                    <img src="{{ asset('assets/front/img/client3.png') }}" class="img-fluid" alt="Client 3">
                </div>
                <div class="item">
                    <img src="{{ asset('assets/front/img/client4.png') }}" class="img-fluid" alt="Client 4">
                </div>
                <div class="item">
                    <img src="{{ asset('assets/front/img/client5.png') }}" class="img-fluid" alt="Client 5">
                </div>
                <div class="item">
                    <img src="{{ asset('assets/front/img/client6.png') }}" class="img-fluid" alt="Client 6">
                </div>
                <div class="item">
                    <img src="{{ asset('assets/front/img/client7.png') }}" class="img-fluid" alt="Client 7">
                </div>
                <div class="item">
                    <img src="{{ asset('assets/front/img/client8.png') }}" class="img-fluid" alt="Client 8">
                </div>
                <div class="item">
                    <img src="{{ asset('assets/front/img/client9.png') }}" class="img-fluid" alt="Client 9">
                </div>
            </div>
        </div>
    </section>

    <section class="about container-fluid service overflow-hidden pt-5" id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title st-center">
                        <h3>WelCome to Sept</h3>
                        <p>We are a creative Designer</p>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s"
                            style="
                    visibility: visible;
                    animation-delay: 0.1s;
                    animation-name: fadeInUp;
                  ">
                            <div class="service-item">
                                <div class="service-inner">
                                    <div class="service-img">
                                        <img src="{{ asset('assets/front/img/service-1.jpg') }}"
                                            class="img-fluid w-100 rounded" alt="Image">
                                    </div>
                                    <div class="service-title">
                                        <div class="service-title-name">
                                            <div class="bg-primary text-center rounded p-3 mx-5 mb-4">
                                                <a href="#" class="h4 text-white mb-0">Job Visa</a>
                                            </div>
                                            <a class="btn bg-light text-secondary rounded-pill py-3 px-5 mb-4"
                                                href="#">Explore More
                                            </a>
                                        </div>
                                        <div class="service-content pb-4">
                                            <a href="#">
                                                <h4 class="text-white mb-4 py-3">Job Visa</h4>
                                            </a>
                                            <div class="px-4">
                                                <p class="mb-4">
                                                    Lorem ipsum dolor sit amet consectetur,
                                                    adipisicing elit. Mollitia fugit dolores nesciunt
                                                    adipisci obcaecati veritatis cum, ratione
                                                    aspernatur autem velit.
                                                </p>
                                                <a class="btn btn-primary border-secondary rounded-pill py-3 px-5"
                                                    href="#">Explore More
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.3s"
                            style="
                    visibility: visible;
                    animation-delay: 0.3s;
                    animation-name: fadeInUp;
                  ">
                            <div class="service-item">
                                <div class="service-inner">
                                    <div class="service-img">
                                        <img src="{{ asset('assets/front/img/service-2.jpg') }}"
                                            class="img-fluid w-100 rounded" alt="Image">
                                    </div>
                                    <div class="service-title">
                                        <div class="service-title-name">
                                            <div class="bg-primary text-center rounded p-3 mx-5 mb-4">
                                                <a href="#" class="h4 text-white mb-0">Business Visa
                                                </a>
                                            </div>
                                            <a class="btn bg-light text-secondary rounded-pill py-3 px-5 mb-4"
                                                href="#">Explore More
                                            </a>
                                        </div>
                                        <div class="service-content pb-4">
                                            <a href="#">
                                                <h4 class="text-white mb-4 py-3">Business Visa</h4>
                                            </a>
                                            <div class="px-4">
                                                <p class="mb-4">
                                                    Lorem ipsum dolor sit amet consectetur,
                                                    adipisicing elit. Mollitia fugit dolores nesciunt
                                                    adipisci obcaecati veritatis cum, ratione
                                                    aspernatur autem velit.
                                                </p>
                                                <a class="btn btn-primary border-secondary rounded-pill text-white py-3 px-5"
                                                    href="#">Explore More
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.5s"
                            style="
                    visibility: visible;
                    animation-delay: 0.5s;
                    animation-name: fadeInUp;
                  ">
                            <div class="service-item">
                                <div class="service-inner">
                                    <div class="service-img">
                                        <img src="{{ asset('assets/front/img/service-3.jpg') }}"
                                            class="img-fluid w-100 rounded" alt="Image">
                                    </div>
                                    <div class="service-title">
                                        <div class="service-title-name">
                                            <div class="bg-primary text-center rounded p-3 mx-5 mb-4">
                                                <a href="#" class="h4 text-white mb-0">Diplometic Visa
                                                </a>
                                            </div>
                                            <a class="btn bg-light text-secondary rounded-pill py-3 px-5 mb-4"
                                                href="#">Explore More
                                            </a>
                                        </div>
                                        <div class="service-content pb-4">
                                            <a href="#">
                                                <h4 class="text-white mb-4 py-3">
                                                    Diplometic Visa
                                                </h4>
                                            </a>
                                            <div class="px-4">
                                                <p class="mb-4">
                                                    Lorem ipsum dolor sit amet consectetur,
                                                    adipisicing elit. Mollitia fugit dolores nesciunt
                                                    adipisci obcaecati veritatis cum, ratione
                                                    aspernatur autem velit.
                                                </p>
                                                <a class="btn btn-primary border-secondary rounded-pill text-white py-3 px-5"
                                                    href="#">Explore More
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s"
                            style="
                    visibility: visible;
                    animation-delay: 0.1s;
                    animation-name: fadeInUp;
                  ">
                            <div class="service-item">
                                <div class="service-inner">
                                    <div class="service-img">
                                        <img src="{{ asset('assets/front/img/service-1.jpg') }}"
                                            class="img-fluid w-100 rounded" alt="Image">
                                    </div>
                                    <div class="service-title">
                                        <div class="service-title-name">
                                            <div class="bg-primary text-center rounded p-3 mx-5 mb-4">
                                                <a href="#" class="h4 text-white mb-0">Students Visa
                                                </a>
                                            </div>
                                            <a class="btn bg-light text-secondary rounded-pill py-3 px-5 mb-4"
                                                href="#">Explore More
                                            </a>
                                        </div>
                                        <div class="service-content pb-4">
                                            <a href="#">
                                                <h4 class="text-white mb-4 py-3">Students Visa</h4>
                                            </a>
                                            <div class="px-4">
                                                <p class="mb-4">
                                                    Lorem ipsum dolor sit amet consectetur,
                                                    adipisicing elit. Mollitia fugit dolores nesciunt
                                                    adipisci obcaecati veritatis cum, ratione
                                                    aspernatur autem velit.
                                                </p>
                                                <a class="btn btn-primary border-secondary rounded-pill text-white py-3 px-5"
                                                    href="#">Explore More
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.3s"
                            style="
                    visibility: visible;
                    animation-delay: 0.3s;
                    animation-name: fadeInUp;
                  ">
                            <div class="service-item">
                                <div class="service-inner">
                                    <div class="service-img">
                                        <img src="{{ asset('assets/front/img/service-2.jpg') }}"
                                            class="img-fluid w-100 rounded" alt="Image">
                                    </div>
                                    <div class="service-title">
                                        <div class="service-title-name">
                                            <div class="bg-primary text-center rounded p-3 mx-5 mb-4">
                                                <a href="#" class="h4 text-white mb-0">Residence Visa
                                                </a>
                                            </div>
                                            <a class="btn bg-light text-secondary rounded-pill py-3 px-5 mb-4"
                                                href="#">Explore More
                                            </a>
                                        </div>
                                        <div class="service-content pb-4">
                                            <a href="#">
                                                <h4 class="text-white mb-4 py-3">Residence Visa</h4>
                                            </a>
                                            <div class="px-4">
                                                <p class="mb-4">
                                                    Lorem ipsum dolor sit amet consectetur,
                                                    adipisicing elit. Mollitia fugit dolores nesciunt
                                                    adipisci obcaecati veritatis cum, ratione
                                                    aspernatur autem velit.
                                                </p>
                                                <a class="btn btn-primary border-secondary rounded-pill text-white py-3 px-5"
                                                    href="#">Explore More
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.5s"
                            style="
                    visibility: visible;
                    animation-delay: 0.5s;
                    animation-name: fadeInUp;
                  ">
                            <div class="service-item">
                                <div class="service-inner">
                                    <div class="service-img">
                                        <img src="{{ asset('assets/front/img/service-3.jpg') }}"
                                            class="img-fluid w-100 rounded" alt="Image">
                                    </div>
                                    <div class="service-title">
                                        <div class="service-title-name">
                                            <div class="bg-primary text-center rounded p-3 mx-5 mb-4">
                                                <a href="#" class="h4 text-white mb-0">Tourist Visa
                                                </a>
                                            </div>
                                            <a class="btn bg-light text-secondary rounded-pill py-3 px-5 mb-4"
                                                href="#">Explore More
                                            </a>
                                        </div>
                                        <div class="service-content pb-4">
                                            <a href="#">
                                                <h4 class="text-white mb-4 py-3">Tourist Visa</h4>
                                            </a>
                                            <div class="px-4">
                                                <p class="mb-4">
                                                    Lorem ipsum dolor sit amet consectetur,
                                                    adipisicing elit. Mollitia fugit dolores nesciunt
                                                    adipisci obcaecati veritatis cum, ratione
                                                    aspernatur autem velit.
                                                </p>
                                                <a class="btn btn-primary border-secondary rounded-pill text-white py-3 px-5"
                                                    href="#">Explore More
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="videos py-5 site-blocks-cover overlay inner-page-cover"
        style="background-image: url({{ asset('assets/front/img/hero_bg_4.jpg') }}); background-attachment: fixed;">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-12">
                    <div class="section-title st-center">
                        <h3>Some Of Our Clients</h3>
                        <p>Avocent deditum long</p>
                    </div>
                </div>



                <div class="col-md-7" data-aos="fade-up" data-aos-delay="400">
                    <a href="https://vimeo.com/channels/staffpicks/93951774"
                        class="play-single-big mb-4 d-inline-block popup-vimeo"><span class="icon-play"></span></a>
                    <h2 class="text-white font-weight-light mb-5 h1">View Our Services By Watching This Short Video</h2>

                </div>
            </div>
        </div>
        </div>
    </section>


    <section class="keybenefits" id="portfolio">
        <!-- Features Start -->
        <div class="container-fluid features overflow-hidden py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title st-center">
                            <h3>Some Of Our Clients</h3>
                            <p>Avocent deditum long</p>
                        </div>
                    </div>
                </div>
                <div class="row g-4 justify-content-center text-center">
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="feature-item text-center p-4">
                            <div class="feature-icon p-3 mb-4">
                                <i class="fas fa-dollar-sign fa-4x text-primary"></i>
                            </div>
                            <div class="feature-content d-flex flex-column">
                                <h5 class="mb-3">Cost-Effective</h5>
                                <p class="mb-3">Dolor, sit amet consectetur adipisicing elit. Soluta inventore cum
                                    accusamus,</p>
                                <a class="btn btn-secondary rounded-pill" href="#">Read More<i
                                        class="fas fa-arrow-right ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="feature-item text-center p-4">
                            <div class="feature-icon p-3 mb-4">
                                <i class="fab fa-cc-visa fa-4x text-primary"></i>
                            </div>
                            <div class="feature-content d-flex flex-column">
                                <h5 class="mb-3">Visa Assistance</h5>
                                <p class="mb-3">Dolor, sit amet consectetur adipisicing elit. Soluta inventore cum
                                    accusamus,</p>
                                <a class="btn btn-secondary rounded-pill" href="#">Read More<i
                                        class="fas fa-arrow-right ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="feature-item text-center p-4">
                            <div class="feature-icon p-3 mb-4">
                                <i class="fas fa-atlas fa-4x text-primary"></i>
                            </div>
                            <div class="feature-content d-flex flex-column">
                                <h5 class="mb-3">Faster Processing</h5>
                                <p class="mb-3">Dolor, sit amet consectetur adipisicing elit. Soluta inventore cum
                                    accusamus,</p>
                                <a class="btn btn-secondary rounded-pill" href="#">Read More<i
                                        class="fas fa-arrow-right ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="feature-item text-center p-4">
                            <div class="feature-icon p-3 mb-4">
                                <i class="fas fa-users fa-4x text-primary"></i>
                            </div>
                            <div class="feature-content d-flex flex-column">
                                <h5 class="mb-3">Direct Interviews</h5>
                                <p class="mb-3">Dolor, sit amet consectetur adipisicing elit. Soluta inventore cum
                                    accusamus,</p>
                                <a class="btn btn-secondary rounded-pill" href="#">Read More<i
                                        class="fas fa-arrow-right ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="feature-item text-center p-4">
                            <div class="feature-icon p-3 mb-4">
                                <i class="fas fa-dollar-sign fa-4x text-primary"></i>
                            </div>
                            <div class="feature-content d-flex flex-column">
                                <h5 class="mb-3">Cost-Effective</h5>
                                <p class="mb-3">Dolor, sit amet consectetur adipisicing elit. Soluta inventore cum
                                    accusamus,</p>
                                <a class="btn btn-secondary rounded-pill" href="#">Read More<i
                                        class="fas fa-arrow-right ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="feature-item text-center p-4">
                            <div class="feature-icon p-3 mb-4">
                                <i class="fab fa-cc-visa fa-4x text-primary"></i>
                            </div>
                            <div class="feature-content d-flex flex-column">
                                <h5 class="mb-3">Visa Assistance</h5>
                                <p class="mb-3">Dolor, sit amet consectetur adipisicing elit. Soluta inventore cum
                                    accusamus,</p>
                                <a class="btn btn-secondary rounded-pill" href="#">Read More<i
                                        class="fas fa-arrow-right ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="feature-item text-center p-4">
                            <div class="feature-icon p-3 mb-4">
                                <i class="fas fa-atlas fa-4x text-primary"></i>
                            </div>
                            <div class="feature-content d-flex flex-column">
                                <h5 class="mb-3">Faster Processing</h5>
                                <p class="mb-3">Dolor, sit amet consectetur adipisicing elit. Soluta inventore cum
                                    accusamus,</p>
                                <a class="btn btn-secondary rounded-pill" href="#">Read More<i
                                        class="fas fa-arrow-right ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="feature-item text-center p-4">
                            <div class="feature-icon p-3 mb-4">
                                <i class="fas fa-users fa-4x text-primary"></i>
                            </div>
                            <div class="feature-content d-flex flex-column">
                                <h5 class="mb-3">Direct Interviews</h5>
                                <p class="mb-3">Dolor, sit amet consectetur adipisicing elit. Soluta inventore cum
                                    accusamus,</p>
                                <a class="btn btn-secondary rounded-pill" href="#">Read More<i
                                        class="fas fa-arrow-right ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <a class="btn btn-primary border-secondary rounded-pill py-3 px-5 wow fadeInUp"
                            data-wow-delay="0.1s" href="#">More Features</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Features End -->
    </section>

     <section class="roadmap-area section-padding" id="roadmap">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="heading">
                            <h5>History Timeline</h5>
                            <div class="space-10"></div>
                            <h1>Development Roadmap</h1>
                        </div>
                        <div class="space-60 d-none d-sm-block"></div>
                    </div>
                </div>
                <div class="roadmap-carousel owl-carousel">
                    <div class="roadmap-item">
                        <div class="single-roadmap text-center road-left">
                            <div class="single-roadmap-img">
                                <img src="{{ asset('assets/front/img/roadmap-1.png') }}" alt="">
                            </div>
                            <div class="space-30"></div>
                            <div class="roadmap-text">
                                <p>01.03.2017</p>
                                <div class="space-10"></div>
                                <h5>Concept & Whitepaper</h5>
                                <p>
                                    The recording starts with the patter of a summer squall.
                                    Later, a drifting tone like that of a violin appears.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="roadmap-item">
                        <div class="single-roadmap road-right">
                            <div class="row">
                                <div class="col-5 align-self-center">
                                    <div class="single-roadmap-img">
                                        <img src="{{ asset('assets/front/img/roadmap-2.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="roadmap-text">
                                        <p>21.06.2017</p>
                                        <h5>Recruitment of Our Team</h5>
                                        <p>
                                            The recording starts with the patter of a summer squall.
                                            Later, a drifting tone like that of a violin appears.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="roadmap-item">
                        <div class="single-roadmap text-center road-left">
                            <div class="single-roadmap-img">
                                <img src="{{ asset('assets/front/img/roadmap-4.png') }}" alt="">
                            </div>
                            <div class="space-30"></div>
                            <div class="roadmap-text">
                                <p>31.08.2017</p>
                                <div class="space-10"></div>
                                <h5>Core Development</h5>
                                <p>
                                    The recording starts with the patter of a summer squall.
                                    Later, a drifting tone like that of a violin appears.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="roadmap-item">
                        <div class="single-roadmap road-right">
                            <div class="row">
                                <div class="col-5 align-self-center">
                                    <div class="single-roadmap-img">
                                        <img src="{{ asset('assets/front/img/roadmap-5.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="roadmap-text">
                                        <p>30.11.2017</p>
                                        <h5>Main Development</h5>
                                        <p>
                                            The recording starts with the patter of a summer squall.
                                            Later, a drifting tone like that of a violin appears.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>

        <section class="portfolio" id="portfolio">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 no-padding">
                        <div class="section-title st-center">
                            <h3>What we have done</h3>
                            <p>Avocent deditum long</p>
                        </div>
                        <div class="filter mb40">
                            <form id="filter">
                                <fieldset class="group">
                                    <label class="btn btn-default btn-main">
                                        <input type="radio" name="filter" value="all" checked="checked">All
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="filter" value="photography">Photography
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="filter" value="design">Design
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="filter" value="codding">Codding
                                    </label>
                                </fieldset>
                            </form>
                            <!-- #filter -->
                        </div>
                        <!-- .filter .mb40 -->
                        <div class="grid">
                            <figure class="portfolio-item" data-groups='["photography"]'>
                                <img src="{{ asset('assets/front/img/portfolio.jpg') }}" alt="">
                                <figcaption>
                                    <h2>Nice
                                        <span>Lily</span>
                                    </h2>
                                    <p>Lily likes to play with crayons and pencils</p>
                                    <a href="#" class="btn btn-main">
                                        <i class="fa fa-link"></i> View more
                                    </a>
                                </figcaption>
                            </figure>
                            <figure class="portfolio-item" data-groups='["design"]'>
                                <img src="{{ asset('assets/front/img/portfolio2.jpg') }}" alt="">
                                <figcaption>
                                    <h2>Nice
                                        <span>Lily</span>
                                    </h2>
                                    <p>Lily likes to play with crayons and pencils</p>
                                    <a href="#" class="btn btn-main">
                                        <i class="fa fa-link"></i> View more
                                    </a>
                                </figcaption>
                            </figure>
                            <figure class="portfolio-item" data-groups='["photography"]'>
                                <img src="{{ asset('assets/front/img/portfolio3.jpg') }}" alt="">
                                <figcaption>
                                    <h2>Nice
                                        <span>Lily</span>
                                    </h2>
                                    <p>Lily likes to play with crayons and pencils</p>
                                    <a href="#" class="btn btn-main">
                                        <i class="fa fa-link"></i> View more
                                    </a>
                                </figcaption>
                            </figure>
                            <figure class="portfolio-item" data-groups='["design"]'>
                                <img src="{{ asset('assets/front/img/portfolio4.jpg') }}" alt="">
                                <figcaption>
                                    <h2>Nice
                                        <span>Lily</span>
                                    </h2>
                                    <p>Lily likes to play with crayons and pencils</p>
                                    <a href="#" class="btn btn-main">
                                        <i class="fa fa-link"></i> View more
                                    </a>
                                </figcaption>
                            </figure>
                            <figure class="portfolio-item" data-groups='["design"]'>
                                <img src="{{ asset('assets/front/img/portfolio5.jpg') }}" alt="">
                                <figcaption>
                                    <h2>Nice
                                        <span>Lily</span>
                                    </h2>
                                    <p>Lily likes to play with crayons and pencils</p>
                                    <a href="#" class="btn btn-main">
                                        <i class="fa fa-link"></i> View more
                                    </a>
                                </figcaption>
                            </figure>
                            <figure class="portfolio-item" data-groups='["photography"]'>
                                <img src="{{ asset('assets/front/img/portfolio6.jpg') }}" alt="">
                                <figcaption>
                                    <h2>Nice
                                        <span>Lily</span>
                                    </h2>
                                    <p>Lily likes to play with crayons and pencils</p>
                                    <a href="#" class="btn btn-main">
                                        <i class="fa fa-link"></i> View more
                                    </a>
                                </figcaption>
                            </figure>
                            <figure class="portfolio-item" data-groups='["codding"]'>
                                <img src="{{ asset('assets/front/img/portfolio7.jpg') }}" alt="">
                                <figcaption>
                                    <h2>Nice
                                        <span>Lily</span>
                                    </h2>
                                    <p>Lily likes to play with crayons and pencils</p>
                                    <a href="#" class="btn btn-main">
                                        <i class="fa fa-link"></i> View more
                                    </a>
                                </figcaption>
                            </figure>
                            <figure class="portfolio-item" data-groups='["photography"]'>
                                <img src="{{ asset('assets/front/img/portfolio8.jpg') }}" alt="">
                                <figcaption>
                                    <h2>Nice
                                        <span>Lily</span>
                                    </h2>
                                    <p>Lily likes to play with crayons and pencils</p>
                                    <a href="#" class="btn btn-main">
                                        <i class="fa fa-link"></i> View more
                                    </a>
                                </figcaption>
                            </figure>
                            <figure class="portfolio-item" data-groups='["codding"]'>
                                <img src="{{ asset('assets/front/img/portfolio9.jpg') }}" alt="">
                                <figcaption>
                                    <h2>Nice
                                        <span>Lily</span>
                                    </h2>
                                    <p>Lily likes to play with crayons and pencils</p>
                                    <a href="#" class="btn btn-main">
                                        <i class="fa fa-link"></i> View more
                                    </a>
                                </figcaption>
                            </figure>
                            <figure class="portfolio-item" data-groups='["codding"]'>
                                <img src="{{ asset('assets/front/img/portfolio10.jpg') }}" alt="">
                                <figcaption>
                                    <h2>Nice
                                        <span>Lily</span>
                                    </h2>
                                    <p>Lily likes to play with crayons and pencils</p>
                                    <a href="#" class="btn btn-main">
                                        <i class="fa fa-link"></i> View more
                                    </a>
                                </figcaption>
                            </figure>
                            <figure class="portfolio-item" data-groups='["design"]'>
                                <img src="{{ asset('assets/front/img/portfolio11.jpg') }}" alt="">
                                <figcaption>
                                    <h2>Nice
                                        <span>Lily</span>
                                    </h2>
                                    <p>Lily likes to play with crayons and pencils</p>
                                    <a href="#" class="btn btn-main">
                                        <i class="fa fa-link"></i> View more
                                    </a>
                                </figcaption>
                            </figure>
                            <figure class="portfolio-item" data-groups='["design"]'>
                                <img src="{{ asset('assets/front/img/portfolio12.jpg') }}" alt="">
                                <figcaption>
                                    <h2>Nice
                                        <span>Lily</span>
                                    </h2>
                                    <p>Lily likes to play with crayons and pencils</p>
                                    <a href="#" class="btn btn-main">
                                        <i class="fa fa-link"></i> View more
                                    </a>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="call-2-acction" data-stellar-background-ratio="0.4" style="background-position: 0% 16.48px">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="c2a">
                            <h2>Omnibus reliquar rebus</h2>
                            <p>
                                Evertitur depravatum illo tamquam novum, possent intus
                                laudatur hinc grate aristoteli per splendido soluta fabulae,
                                ne aristippi cui deleniti nostros illud.
                            </p>
                            <a href="#" class="btn btn-main btn-lg">Purchase Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="industries">
            <div class="container-fluid training overflow-hidden bg-light py-5">
                <div class="container py-5">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title st-center">
                                <h3>Industries</h3>
                                <p>Avocent deditum long</p>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.1s"
                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                            <div class="training-item">
                                <div class="training-inner">
                                    <img src="{{ asset('assets/front/img/training-1.jpg') }}" class="img-fluid w-100 rounded" alt="Image">
                                    <div class="training-title-name">
                                        <a href="#" class="h4 text-white mb-0">IELTS</a>
                                        <a href="#" class="h4 text-white mb-0">Coaching</a>
                                    </div>
                                </div>
                                <div class="training-content bg-secondary rounded-bottom p-4">
                                    <a href="#">
                                        <h4 class="text-white">IELTS Coaching</h4>
                                    </a>
                                    <p class="text-white-50">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                        Autem, veritatis.</p>
                                    <a class="btn btn-secondary rounded-pill text-white p-0" href="#">Read More <i
                                            class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.3s"
                            style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                            <div class="training-item">
                                <div class="training-inner">
                                    <img src="{{ asset('assets/front/img/training-2.jpg') }}" class="img-fluid w-100 rounded"
                                        alt="Image">
                                    <div class="training-title-name">
                                        <a href="#" class="h4 text-white mb-0">TOEFL</a>
                                        <a href="#" class="h4 text-white mb-0">Coaching</a>
                                    </div>
                                </div>
                                <div class="training-content bg-secondary rounded-bottom p-4">
                                    <a href="#">
                                        <h4 class="text-white">TOEFL Coaching</h4>
                                    </a>
                                    <p class="text-white-50">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                        Autem, veritatis.</p>
                                    <a class="btn btn-secondary rounded-pill text-white p-0" href="#">Read More <i
                                            class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.5s"
                            style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                            <div class="training-item">
                                <div class="training-inner">
                                    <img src="{{ asset('assets/front/img/training-3.jpg') }}" class="img-fluid w-100 rounded"
                                        alt="Image">
                                    <div class="training-title-name">
                                        <a href="#" class="h4 text-white mb-0">PTE</a>
                                        <a href="#" class="h4 text-white mb-0">Coaching</a>
                                    </div>
                                </div>
                                <div class="training-content bg-secondary rounded-bottom p-4">
                                    <a href="#">
                                        <h4 class="text-white">PTE Coaching</h4>
                                    </a>
                                    <p class="text-white-50">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                        Autem, veritatis.</p>
                                    <a class="btn btn-secondary rounded-pill text-white p-0" href="#">Read More <i
                                            class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.7s"
                            style="visibility: visible; animation-delay: 0.7s; animation-name: fadeInUp;">
                            <div class="training-item">
                                <div class="training-inner">
                                    <img src="{{ asset('assets/front/img/training-4.jpg') }}" class="img-fluid w-100 rounded"
                                        alt="Image">
                                    <div class="training-title-name">
                                        <a href="#" class="h4 text-white mb-0">OET</a>
                                        <a href="#" class="h4 text-white mb-0">Coaching</a>
                                    </div>
                                </div>
                                <div class="training-content bg-secondary rounded-bottom p-4">
                                    <a href="#">
                                        <h4 class="text-white">OET Coaching</h4>
                                    </a>
                                    <p class="text-white-50">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                        Autem, veritatis.</p>
                                    <a class="btn btn-secondary rounded-pill text-white p-0" href="#">Read More <i
                                            class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <a class="btn btn-primary border-secondary rounded-pill py-3 px-5 wow fadeInUp"
                                data-wow-delay="0.1s" href="#"
                                style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">View
                                More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="funfacts" data-stellar-background-ratio="0.4" style="background-position: 50% 47.58px;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title st-center">
                            <h3>Industries</h3>
                            <p>Avocent deditum long</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="funfact">
                            <div class="st-funfact-icon"><i class="fa fa-briefcase"></i></div>
                            <div class="st-funfact-counter"><span class="st-ff-count" data-from="0" data-to="25964"
                                    data-runit="1">25964</span>+</div>
                            <strong class="funfact-title">Projects</strong>
                        </div><!-- .funfact -->
                    </div>
                    <div class="col-md-3">
                        <div class="funfact">
                            <div class="st-funfact-icon"><i class="fa fa-clock-o"></i></div>
                            <div class="st-funfact-counter"><span class="st-ff-count" data-from="0" data-to="35469"
                                    data-runit="1">35469</span>+</div>
                            <strong class="funfact-title">Hours Work</strong>
                        </div><!-- .funfact -->
                    </div>
                    <div class="col-md-3">
                        <div class="funfact">
                            <div class="st-funfact-icon"><i class="fa fa-send"></i></div>
                            <div class="st-funfact-counter"><span class="st-ff-count" data-from="0" data-to="86214"
                                    data-runit="1">86214</span>+</div>
                            <strong class="funfact-title">E-mail</strong>
                        </div><!-- .funfact -->
                    </div>
                    <div class="col-md-3">
                        <div class="funfact">
                            <div class="st-funfact-icon"><i class="fa fa-magic"></i></div>
                            <div class="st-funfact-counter"><span class="st-ff-count" data-from="0" data-to="3647"
                                    data-runit="1">3647</span>+</div>
                            <strong class="funfact-title">Completed</strong>
                        </div><!-- .funfact -->
                    </div>
                </div>
            </div>
        </section>

        <section id="team-section">
            <div class="container-fluid training overflow-hidden bg-light py-5">
                <div class="container py-5">

                    <div class="row">
                        <div class="col-12">
                            <div class="section-title st-center">
                                <h3>Industries</h3>
                                <p>Avocent deditum long</p>
                            </div>
                        </div>
                    </div>

                    <div class="team-member-wrapper clearfix">

                        <div class="float-left">
                            <div class="single-team-member">

                                <div class="img">
                                    <img src="{{ asset('assets/front/img/team/1.jpg') }}" alt="" class="img-responsive">

                                    <div class="opacity tran4s">
                                        <h4>Healthcare</h4>
                                        <span>Industry</span>
                                        <p>Healthcare software, HMS, Telemedicine, EMR & Patient Management.</p>
                                    </div>
                                </div>

                                <div class="member-name">
                                    <h6>Healthcare</h6>
                                    <p>Industry</p>

                                    <ul>
                                        <li><a href="#" class="tran3s round-border"><i
                                                    class="fa fa-heartbeat"></i></a></li>
                                        <li><a href="#" class="tran3s round-border"><i
                                                    class="fa fa-hospital-o"></i></a></li>
                                        <li><a href="#" class="tran3s round-border"><i
                                                    class="fa fa-medkit"></i></a></li>
                                        <li><a href="#" class="tran3s round-border"><i
                                                    class="fa fa-plus-square"></i></a></li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <div class="float-left">
                            <div class="single-team-member">

                                <div class="img">
                                    <img src="{{ asset('assets/front/img/team/2.jpg') }}" alt="" class="img-responsive">

                                    <div class="opacity tran4s">
                                        <h4>E-Commerce</h4>
                                        <span>Industry</span>
                                        <p>Custom Ecommerce, Marketplace, Inventory, Payment Gateway.</p>
                                    </div>
                                </div>

                                <div class="member-name">
                                    <h6>E-Commerce</h6>
                                    <p>Industry</p>

                                    <ul>
                                        <li><a href="#" class="tran3s round-border"><i
                                                    class="fa fa-shopping-cart"></i></a></li>
                                        <li><a href="#" class="tran3s round-border"><i
                                                    class="fa fa-credit-card"></i></a></li>
                                        <li><a href="#" class="tran3s round-border"><i
                                                    class="fa fa-truck"></i></a></li>
                                        <li><a href="#" class="tran3s round-border"><i
                                                    class="fa fa-globe"></i></a></li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <div class="float-left">
                            <div class="single-team-member">

                                <div class="img">
                                    <img src="{{ asset('assets/front/img/team/3.jpg') }}" alt="" class="img-responsive">

                                    <div class="opacity tran4s">
                                        <h4>Education</h4>
                                        <span>Industry</span>
                                        <p>School ERP, LMS, Online Classes, Student Management System.</p>
                                    </div>
                                </div>

                                <div class="member-name">
                                    <h6>Education</h6>
                                    <p>Industry</p>

                                    <ul>
                                        <li><a href="#" class="tran3s round-border"><i
                                                    class="fa fa-graduation-cap"></i></a></li>
                                        <li><a href="#" class="tran3s round-border"><i
                                                    class="fa fa-book"></i></a></li>
                                        <li><a href="#" class="tran3s round-border"><i
                                                    class="fa fa-laptop"></i></a></li>
                                        <li><a href="#" class="tran3s round-border"><i
                                                    class="fa fa-university"></i></a></li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>

         <section class="call-us">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3>If you like to work with us</h3>
                        <a href="#" class="btn btn-default-o btn-lg">Call Us Now</a>
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

                <div class="faq-wrapper">

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
        </section>

@endsection
