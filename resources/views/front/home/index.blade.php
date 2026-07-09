@extends('front.layouts.app')
@section('content')
    {{-- <section>
        <!-- slider Area Start-->
        <div class="slider-area">
            <div class="slider-active">
                <div class="single-slider hero-overly slider-height d-flex align-items-center"
                    data-background="{{ asset('assets/front/img/hero/h1_hero.jpg') }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-11">
                                <div class="hero__caption">
                                    <div class="hero-text1">
                                        <span data-animation="fadeInUp" data-delay=".3s">hand car wash and detailing service
                                        </span>
                                    </div>
                                    <h1 data-animation="fadeInUp" data-delay=".5s">advanced</h1>
                                    <div class="stock-text" data-animation="fadeInUp" data-delay=".8s">
                                        <h2>Construction</h2>
                                        <h2>Construction</h2>
                                    </div>
                                    <div class="hero-text2 mt-110" data-animation="fadeInUp" data-delay=".9s">
                                        <span>
                                            <a href="services.html">Our Services</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-slider hero-overly slider-height d-flex align-items-center"
                    data-background="{{ asset('assets/front/img/hero/h1_hero.jpg') }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-11">
                                <div class="hero__caption">
                                    <div class="hero-text1">
                                        <span data-animation="fadeInUp" data-delay=".3s">hand car wash and detailing service
                                        </span>
                                    </div>
                                    <h1 data-animation="fadeInUp" data-delay=".5s">advanced</h1>
                                    <div class="stock-text" data-animation="fadeInUp" data-delay=".8s">
                                        <h2>Construction</h2>
                                        <h2>Construction</h2>
                                    </div>
                                    <div class="hero-text2 mt-110" data-animation="fadeInUp" data-delay=".9s">
                                        <span>
                                            <a href="services.html">Our Services</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
        <!-- slider Area End-->
        <!-- about section start -->
        <section class="about" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title st-center">
                            <h3>WelCome to Sept</h3>
                            <p>We are a creative Designer</p>
                        </div>
                        <div class="row mb90">
                            <div class="col-md-6">
                                <p>
                                    Texit l, habere se indocti magnosque culpa gravioribus
                                    discedere eas indignae diogenem, praetermissum effugiendorum
                                    vult dicent, periculum dolere putat. Iucunditatem quid
                                    turbulenta patre eae depravatum talem elaborare plerisque
                                    repellere, o potiendi tuo aliter, militaris sint tranquillat
                                    liberalitati. Locus delicata divelli intemperantes audeam
                                    maximisque sitne pulcherrimum aegritudines studium. Habent
                                    inveniri fidelissimae aequi andriam laudabilis. Libido
                                    censet assiduitas quae probantur tantalo exquisitaque erunt
                                    laudatur optari. Late suapte veterum enim qui magna securi
                                    eaque proficiscuntur.
                                </p>
                            </div>
                            <div class="col-md-6">
                                <img src="{{ asset('assets/front/img/about.jpg') }}" alt="" class="img-responsive">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="st-member">
                                    <div class="st-member-img">
                                        <img src="{{ asset('assets/front/img/member1.png') }}" alt="" class="img-responsive">
                                    </div>
                                    <div class="st-member-info">
                                        <strong class="st-member-name">Jerry Ward</strong>
                                        <p class="st-member-pos">CEO</p>
                                        <div class="skills">
                                            <div class="skill">
                                                <strong>HTML</strong>
                                                <span>90%</span>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-sept" role="progressbar"
                                                        aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: 90%">
                                                        <span class="sr-only">90% Complete</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="skill">
                                                <strong>CSS</strong>
                                                <span>70%</span>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-sept" role="progressbar"
                                                        aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: 70%">
                                                        <span class="sr-only">70% Complete</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="skill">
                                                <strong>JavaScript</strong>
                                                <span>86%</span>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-sept" role="progressbar"
                                                        aria-valuenow="86" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: 86%">
                                                        <span class="sr-only">86% Complete</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="st-member-social">
                                            <ul>
                                                <li>
                                                    <a href="#" class="facebook" data-toggle="tooltip"
                                                        data-placement="top" title="" data-original-title="Facebook">
                                                        <i class="fab fa-facebook-f">
                                                        </i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="twitter" data-toggle="tooltip"
                                                        data-placement="top" title="" data-original-title="Twitter">
                                                        <i class="fab fa-twitter">
                                                        </i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dribbble" data-toggle="tooltip"
                                                        data-placement="top" title=""
                                                        data-original-title="Dribbble">
                                                        <i class="fab fa-linkedin-in">
                                                        </i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="st-member">
                                    <div class="st-member-img">
                                        <img src="{{ asset('assets/front/img/member2.png') }}" alt="" class="img-responsive">
                                    </div>
                                    <div class="st-member-info">
                                        <strong class="st-member-name">Sarah Moore</strong>
                                        <p class="st-member-pos">Designer</p>
                                        <div class="skills">
                                            <div class="skill">
                                                <strong>HTML</strong>
                                                <span>90%</span>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-sept" role="progressbar"
                                                        aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: 90%">
                                                        <span class="sr-only">90% Complete</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="skill">
                                                <strong>CSS</strong>
                                                <span>70%</span>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-sept" role="progressbar"
                                                        aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: 70%">
                                                        <span class="sr-only">70% Complete</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="skill">
                                                <strong>JavaScript</strong>
                                                <span>86%</span>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-sept" role="progressbar"
                                                        aria-valuenow="86" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: 86%">
                                                        <span class="sr-only">86% Complete</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="st-member-social">
                                            <ul>
                                                <li>
                                                    <a href="#" class="facebook" data-toggle="tooltip"
                                                        data-placement="top" title=""
                                                        data-original-title="Facebook">
                                                        <i class="fab fa-facebook-f">
                                                        </i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="twitter" data-toggle="tooltip"
                                                        data-placement="top" title=""
                                                        data-original-title="Twitter">
                                                        <i class="fab fa-twitter">
                                                        </i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dribbble" data-toggle="tooltip"
                                                        data-placement="top" title=""
                                                        data-original-title="Dribbble">
                                                        <i class="fab fa-linkedin-in">
                                                        </i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="st-member">
                                    <div class="st-member-img">
                                        <img src="{{ asset('assets/front/img/member3.png') }}" alt="" class="img-responsive">
                                    </div>
                                    <div class="st-member-info">
                                        <strong class="st-member-name">Rose Johnson</strong>
                                        <p class="st-member-pos">Developer</p>
                                        <div class="skills">
                                            <div class="skill">
                                                <strong>HTML</strong>
                                                <span>90%</span>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-sept" role="progressbar"
                                                        aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: 90%">
                                                        <span class="sr-only">90% Complete</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="skill">
                                                <strong>CSS</strong>
                                                <span>70%</span>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-sept" role="progressbar"
                                                        aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: 70%">
                                                        <span class="sr-only">70% Complete</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="skill">
                                                <strong>JavaScript</strong>
                                                <span>86%</span>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-sept" role="progressbar"
                                                        aria-valuenow="86" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: 86%">
                                                        <span class="sr-only">86% Complete</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="st-member-social">
                                            <ul>
                                                <li>
                                                    <a href="#" class="facebook" data-toggle="tooltip"
                                                        data-placement="top" title=""
                                                        data-original-title="Facebook">
                                                        <i class="fab fa-facebook-f">
                                                        </i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="twitter" data-toggle="tooltip"
                                                        data-placement="top" title=""
                                                        data-original-title="Twitter">
                                                        <i class="fab fa-twitter">
                                                        </i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dribbble" data-toggle="tooltip"
                                                        data-placement="top" title=""
                                                        data-original-title="Dribbble">
                                                        <i class="fab fa-linkedin-in">
                                                        </i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about section end -->

        <!-- Counter Facts Start -->
        <div class="container-fluid counter-facts py-5">
            <div class="container py-5">
                <div class="row g-4">
                    <div class="col-12 col-sm-6 col-md-6 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="counter">
                            <div class="counter-icon">
                                <i class="fas fa-passport"></i>
                            </div>
                            <div class="counter-content">
                                <h3>Visa Categories</h3>
                                <div class="d-flex align-items-center justify-content-center">
                                    <span class="counter-value" data-toggle="counter-up">31
                                    </span>
                                    <h4 class="text-secondary mb-0" style="font-weight: 600; font-size: 25px">
                                        +
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="counter">
                            <div class="counter-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="counter-content">
                                <h3>Team Members</h3>
                                <div class="d-flex align-items-center justify-content-center">
                                    <span class="counter-value" data-toggle="counter-up">377
                                    </span>
                                    <h4 class="text-secondary mb-0" style="font-weight: 600; font-size: 25px">
                                        +
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="counter">
                            <div class="counter-icon">
                                <i class="fas fa-user-check"></i>
                            </div>
                            <div class="counter-content">
                                <h3>Visa Process</h3>
                                <div class="d-flex align-items-center justify-content-center">
                                    <span class="counter-value" data-toggle="counter-up">4.9
                                    </span>
                                    <h4 class="text-secondary mb-0" style="font-weight: 600; font-size: 25px">
                                        K
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="counter">
                            <div class="counter-icon">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <div class="counter-content">
                                <h3>Success Rates</h3>
                                <div class="d-flex align-items-center justify-content-center">
                                    <span class="counter-value" data-toggle="counter-up">98
                                    </span>
                                    <h4 class="text-secondary mb-0" style="font-weight: 600; font-size: 25px">
                                        %
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Counter Facts End -->
        <!-- about section start -->
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
                                            <img src="{{ asset('assets/front/img/service-1.jpg') }}" class="img-fluid w-100 rounded"
                                                alt="Image">
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
                                            <img src="{{ asset('assets/front/img/service-2.jpg') }}" class="img-fluid w-100 rounded"
                                                alt="Image">
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
                                            <img src="{{ asset('assets/front/img/service-3.jpg') }}" class="img-fluid w-100 rounded"
                                                alt="Image">
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
                                            <img src="{{ asset('assets/front/img/service-1.jpg') }}" class="img-fluid w-100 rounded"
                                                alt="Image">
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
                                            <img src="{{ asset('assets/front/img/service-2.jpg') }}" class="img-fluid w-100 rounded"
                                                alt="Image">
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
                                            <img src="{{ asset('assets/front/img/service-3.jpg') }}" class="img-fluid w-100 rounded"
                                                alt="Image">
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
        <!-- about section end -->
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
        <section class="clients py-5">
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




            <section class="why-choose-us features bg-grey py-5">
            <div class="container-fluid py-5">
                <div class="container py-5">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title st-center">
                                <h3>Some Of Our Clients</h3>
                                <p>Avocent deditum long</p>
                            </div>
                        </div>
                    </div>
                    <div class="service-item service-item-left">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-5">
                                <div class="service-img p-5 wow fadeInRight" data-wow-delay="0.2s"
                                    style="
                      visibility: visible;
                      animation-delay: 0.2s;
                      animation-name: fadeInRight;
                    ">
                                    <img class="img-fluid rounded-circle" src="{{ asset('assets/front/img/service-1.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="service-text px-5 py-md-5 wow fadeInRight" data-wow-delay="0.5s"
                                    style="
                      visibility: visible;
                      animation-delay: 0.5s;
                      animation-name: fadeInRight;
                    ">
                                    <h3 class="text-uppercase">Fashion Shows</h3>
                                    <p class="mb-4">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Etiam feugiat fermentum urna, sed gravida enim eleifend
                                        vitae. Ut rhoncus non metus at convallis. Maecenas
                                        pharetra placerat mauris. Phasellus quis egestas dui.
                                        Nullam ornare consectetur rhoncus. Praesent elit mauris,
                                        feugiat quis convallis et, egestas a tellus.
                                    </p>
                                    <a class="btn btn-outline-primary border-2 px-4" href="#!">Read More
                                        <i class="fa fa-arrow-right ms-1">
                                        </i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="service-item service-item-right">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-5 order-md-1 text-md-end">
                                <div class="service-img p-5 wow fadeInLeft" data-wow-delay="0.2s"
                                    style="
                      visibility: visible;
                      animation-delay: 0.2s;
                      animation-name: fadeInLeft;
                    ">
                                    <img class="img-fluid rounded-circle" src="{{ asset('assets/front/img/service-2.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="service-text px-5 py-md-5 text-md-end wow fadeInLeft" data-wow-delay="0.5s"
                                    style="
                      visibility: visible;
                      animation-delay: 0.5s;
                      animation-name: fadeInLeft;
                    ">
                                    <h3 class="text-uppercase">Corporate Events</h3>
                                    <p class="mb-4">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Etiam feugiat fermentum urna, sed gravida enim eleifend
                                        vitae. Ut rhoncus non metus at convallis. Maecenas
                                        pharetra placerat mauris. Phasellus quis egestas dui.
                                        Nullam ornare consectetur rhoncus. Praesent elit mauris,
                                        feugiat quis convallis et, egestas a tellus.
                                    </p>
                                    <a class="btn btn-outline-primary border-2 px-4" href="#!">Read More
                                        <i class="fa fa-arrow-right ms-1">
                                        </i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="service-item service-item-left">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-5">
                                <div class="service-img p-5 wow fadeInRight" data-wow-delay="0.2s"
                                    style="
                      visibility: visible;
                      animation-delay: 0.2s;
                      animation-name: fadeInRight;
                    ">
                                    <img class="img-fluid rounded-circle" src="{{ asset('assets/front/img/service-3.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="service-text px-5 py-md-5 wow fadeInRight" data-wow-delay="0.5s"
                                    style="
                      visibility: visible;
                      animation-delay: 0.5s;
                      animation-name: fadeInRight;
                    ">
                                    <h3 class="text-uppercase">Commercial Photo Shots</h3>
                                    <p class="mb-4">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Etiam feugiat fermentum urna, sed gravida enim eleifend
                                        vitae. Ut rhoncus non metus at convallis. Maecenas
                                        pharetra placerat mauris. Phasellus quis egestas dui.
                                        Nullam ornare consectetur rhoncus. Praesent elit mauris,
                                        feugiat quis convallis et, egestas a tellus.
                                    </p>
                                    <a class="btn btn-outline-primary border-2 px-4" href="#!">Read More
                                        <i class="fa fa-arrow-right ms-1">
                                        </i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="service-item service-item-right">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-5 order-md-1 text-md-end">
                                <div class="service-img p-5 wow fadeInLeft" data-wow-delay="0.2s"
                                    style="
                      visibility: visible;
                      animation-delay: 0.2s;
                      animation-name: fadeInLeft;
                    ">
                                    <img class="img-fluid rounded-circle" src="{{ asset('assets/front/img/service-4.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="service-text px-5 py-md-5 text-md-end wow fadeInLeft" data-wow-delay="0.5s"
                                    style="
                      visibility: visible;
                      animation-delay: 0.5s;
                      animation-name: fadeInLeft;
                    ">
                                    <h3 class="text-uppercase">Professional Modeling</h3>
                                    <p class="mb-4">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Etiam feugiat fermentum urna, sed gravida enim eleifend
                                        vitae. Ut rhoncus non metus at convallis. Maecenas
                                        pharetra placerat mauris. Phasellus quis egestas dui.
                                        Nullam ornare consectetur rhoncus. Praesent elit mauris,
                                        feugiat quis convallis et, egestas a tellus.
                                    </p>
                                    <a class="btn btn-outline-primary border-2 px-4" href="#!">Read More
                                        <i class="fa fa-arrow-right ms-1">
                                        </i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

        <section id="casestudies">
            <div class="container-fluid contact overflow-hidden pb-5">
                <div class="container py-5">

                    <!-- Section Title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title st-center">
                                <h3>Industries We Serve</h3>
                                <p>Delivering innovative solutions across multiple industries.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Owl Carousel -->
                    <div class="office-carousel owl-carousel owl-theme">

                        <!-- Item 1 -->
                        <div class="office-item p-4">
                            <div class="office-img mb-4">
                                <img src="{{ asset('assets/front/img/office-2.jpg') }}" class="img-fluid w-100 rounded" alt="">
                            </div>

                            <div class="office-content">
                                <h4>Healthcare</h4>
                                <p>Hospital Management System, Telemedicine, Patient Portal and EMR Solutions.</p>
                            </div>
                        </div>

                        <!-- Item 2 -->
                        <div class="office-item p-4">
                            <div class="office-img mb-4">
                                <img src="{{ asset('assets/front/img/office-1.jpg') }}" class="img-fluid w-100 rounded" alt="">
                            </div>

                            <div class="office-content">
                                <h4>E-Commerce</h4>
                                <p>Online Stores, Multi Vendor Marketplace, Inventory & Payment Gateway.</p>
                            </div>
                        </div>

                        <!-- Item 3 -->
                        <div class="office-item p-4">
                            <div class="office-img mb-4">
                                <img src="{{ asset('assets/front/img/office-3.jpg') }}" class="img-fluid w-100 rounded" alt="">
                            </div>

                            <div class="office-content">
                                <h4>Education</h4>
                                <p>Learning Management Systems, Student Portals and Online Examination.</p>
                            </div>
                        </div>

                        <!-- Item 4 -->
                        <div class="office-item p-4">
                            <div class="office-img mb-4">
                                <img src="{{ asset('assets/front/img/office-4.jpg') }}" class="img-fluid w-100 rounded" alt="">
                            </div>

                            <div class="office-content">
                                <h4>Real Estate</h4>
                                <p>Property Management, CRM and Real Estate Listing Platforms.</p>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </section>


        <section class="subscribe">
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
                    <div class="col-md-12">

                        <form role="form" class="subscribe-form" novalidate="true">
                            <div class="input-group">
                                <input type="email" class="form-control" id="mc-email"
                                    placeholder="Enter E-mail..." name="EMAIL">
                                <span class="input-group-btn">
                                    <button class="btn btn-main btn-lg sub-btn" type="submit">Subscribe!</button>
                                </span>
                            </div>
                        </form>
                        <div class="subscribe-result"></div>
                        <p class="subscribe-or">or</p>
                        <ul class="subscribe-social">
                            <li><a href="#" class="social twitter"><i class="fa fa-twitter"></i> Follow</a></li>
                            <li><a href="#" class="social facebook"><i class="fa fa-facebook"></i> Like</a></li>
                            <li><a href="#" class="social rss"><i class="fa fa-rss"></i> RSS</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!--=================================
            Latest Blog Section
    ==================================-->
        <section id="blog-section" class="section-padding">

            <div class="container">

                <div class="row">
                    <div class="col-12">
                        <div class="section-title st-center">
                            <h3>Industries</h3>
                            <p>Avocent deditum long</p>
                        </div>
                    </div>
                </div>

                <div class="blog-carousel owl-carousel owl-theme">

                    <!-- Blog 1 -->
                    <div class="single-news-item">

                        <div class="img">
                            <img src="{{ asset('assets/front/img/blog/1.jpg') }}" alt="Blog">

                            <a href="blog-details.html" class="opacity tran4s">
                                <i class="fa fa-link"></i>
                            </a>
                        </div>

                        <div class="post">

                            <h6>
                                <a href="blog-details.html" class="tran3s">
                                    Top Web Development Trends in 2026
                                </a>
                            </h6>

                            <a href="#">
                                Posted by
                                <span class="p-color">Admin</span>
                                | 05 July 2026
                            </a>

                            <p>
                                Discover the latest technologies including AI, Laravel,
                                React and cloud computing that are transforming modern businesses.
                                <a href="blog-details.html" class="tran3s">
                                    Read More
                                </a>
                            </p>

                        </div>

                    </div>

                    <!-- Blog 2 -->

                    <div class="single-news-item">

                        <div class="img">
                            <img src="{{ asset('assets/front/img/blog/2.jpg') }}" alt="Blog">

                            <a href="blog-details.html" class="opacity tran4s">
                                <i class="fa fa-link"></i>
                            </a>
                        </div>

                        <div class="post">

                            <h6>
                                <a href="blog-details.html" class="tran3s">
                                    Laravel vs Node.js — Complete Comparison
                                </a>
                            </h6>

                            <a href="#">
                                Posted by
                                <span class="p-color">Admin</span>
                                | 02 July 2026
                            </a>

                            <p>
                                Which framework is best for your next enterprise project?
                                Let's compare Laravel and Node.js in depth.
                                <a href="blog-details.html" class="tran3s">
                                    Read More
                                </a>
                            </p>

                        </div>

                    </div>

                    <!-- Blog 3 -->

                    <div class="single-news-item">

                        <div class="img">
                            <img src="{{ asset('assets/front/img/blog/3.jpg') }}" alt="Blog">

                            <a href="blog-details.html" class="opacity tran4s">
                                <i class="fa fa-link"></i>
                            </a>
                        </div>

                        <div class="post">

                            <h6>
                                <a href="blog-details.html" class="tran3s">
                                    Why Every Business Needs a Professional Website
                                </a>
                            </h6>

                            <a href="#">
                                Posted by
                                <span class="p-color">Admin</span>
                                | 28 June 2026
                            </a>

                            <p>
                                Learn how a professional website increases trust,
                                sales and online visibility.
                                <a href="blog-details.html" class="tran3s">
                                    Read More
                                </a>
                            </p>

                        </div>

                    </div>

                    <!-- Blog 4 -->

                    <div class="single-news-item">

                        <div class="img">
                            <img src="{{ asset('assets/front/img/blog/4.jpg') }}" alt="Blog">

                            <a href="blog-details.html" class="opacity tran4s">
                                <i class="fa fa-link"></i>
                            </a>
                        </div>

                        <div class="post">

                            <h6>
                                <a href="blog-details.html" class="tran3s">
                                    SEO Strategies That Actually Work
                                </a>
                            </h6>

                            <a href="#">
                                Posted by
                                <span class="p-color">Admin</span>
                                | 25 June 2026
                            </a>

                            <p>
                                Improve your rankings using the latest SEO
                                techniques and optimization strategies.
                                <a href="blog-details.html" class="tran3s">
                                    Read More
                                </a>
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!--========================================
                Testimonials
    =========================================-->

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

                <div class="testimonials-carousel owl-carousel owl-theme">

                    <!-- Testimonial 1 -->
                    <div class="testimonial">

                        <div class="testimonial-img">
                            <img src="{{ asset('assets/front/img/testimonial/1.png') }}" alt="">
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
                            <img src="{{ asset('assets/front/img/testimonial/1.png') }}" alt="">
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
                            <img src="{{ asset('assets/front/img/testimonial/1.png') }}" alt="">
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

        </section>


        <!--========================================
                    FAQ SECTION
    =========================================-->

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
        </section> --}}
    @endsection
