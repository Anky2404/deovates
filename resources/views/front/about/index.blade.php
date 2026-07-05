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

<section class="videos py-5 site-blocks-cover overlay inner-page-cover" style="background-image: url({{ asset('assets/front/img/hero_bg_4.jpg') }}); background-attachment: fixed;">
        <div class="container">
             <div class="row align-items-center justify-content-center text-center">
                <div class="col-12">
                    <div class="section-title st-center">
                        <h3>Some Of Our Clients</h3>
                        <p>Avocent deditum long</p>
                    </div>
                </div>



          <div class="col-md-7" data-aos="fade-up" data-aos-delay="400">
            <a href="https://vimeo.com/channels/staffpicks/93951774" class="play-single-big mb-4 d-inline-block popup-vimeo"><span class="icon-play"></span></a>
            <h2 class="text-white font-weight-light mb-5 h1">View Our Services By Watching This Short Video</h2>

          </div>
        </div>
            </div>
        </div>
    </section>




@endsection
