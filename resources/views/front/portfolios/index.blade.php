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

    <section class="service" id="service">
        <div class="container-xxl py-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title st-center">
                        <h3>What we do</h3>
                        <p>Avocent deditum long</p>
                    </div>
                </div>
            </div>
            <div class="container">

                <div class="row">
                    <div class="col-md-3">
                        <div class="st-feature">
                            <div class="st-feature-icon"><i class="fa fa-cog"></i></div>
                            <strong class="st-feature-title">Option Panel</strong>
                            <p>Pro adiuvet, honesto foris liberiusque statuat theseo scribimus mererer percurri geometria.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="st-feature">
                            <div class="st-feature-icon"><i class="fa fa-university"></i></div>
                            <strong class="st-feature-title">Option Panel</strong>
                            <p>Pro adiuvet, honesto foris liberiusque statuat theseo scribimus mererer percurri geometria.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="st-feature">
                            <div class="st-feature-icon"><i class="fa fa-comments-o"></i></div>
                            <strong class="st-feature-title">Option Panel</strong>
                            <p>Pro adiuvet, honesto foris liberiusque statuat theseo scribimus mererer percurri geometria.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="st-feature">
                            <div class="st-feature-icon"><i class="fa fa-life-ring"></i></div>
                            <strong class="st-feature-title">Option Panel</strong>
                            <p>Pro adiuvet, honesto foris liberiusque statuat theseo scribimus mererer percurri geometria.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>


    <section class="features-desc bg-grey">
         <div class="container-xxl py-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title st-center">
                        <h3>Features</h3>
                        <p>Avocent deditum long</p>
                    </div>
                </div>
            </div>
		<div class="container">
			<div class="row">
				<div class="col-md-5">
					<img src="{{ asset('assets/front/img/feature.png') }}" alt="" class="img-responsive">
				</div>
				<div class="col-md-7">
					<h3 class="bottom-line">SOME OF OUR IMPORTANT FEATURES</h3>
					<p>Graeci decore metrodorus conturbamur nostri alii veniamus temperantia audivi, discidia optari pariter
						formidines nimis dissidens quosvis epicureis, iustitia inbecilloque cognoscerem remotis solet duce pondere,
						stoicos amaret, faciam sic reperiuntur, timeam dedocere spatio censet cernantur dicas miseram alienum.
						Attico fonte errem neque, causam nimium reliqui fana, duo sane consequi quos cogitarent dicant profecto.</p>
					<a href="#" class="btn btn-main btn-lg">Read more</a>
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

         <section class="keybenefits bg-grey" id="portfolio">
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
