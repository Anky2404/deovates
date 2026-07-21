{{--
    Shared "What Our Clients Say" testimonials block — reused as-is across
    Home, About, Services, Blog, FAQ, and Testimonials (heading only there;
    the dedicated Testimonials page has its own separate listing heading).
    Hidden entirely when there are no testimonials scoped to this page
    (see Testimonial::scopeOnPage) — never renders an empty shell.

    Params:
    - $page             App\Models\Page|null
    - $sectionContents  array [section_id => data]
    - $testimonials     \Illuminate\Support\Collection<Testimonial> — already
                         page-scoped + active-filtered by the controller
    - $defaultTitle     string — page-specific fallback title
    - $defaultSubtitle  string|null — page-specific fallback subtitle
--}}
@php
    $__testiSection = $page?->sections->firstWhere('slug', 'testimonials-section');
    $__testiContent = $__testiSection ? ($sectionContents[$__testiSection->id] ?? []) : [];
@endphp
@if ($testimonials->isNotEmpty())
    <section class="testimonials">

        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center">
                        @include('front.partials._section_heading', [
                            'content' => $__testiContent,
                            'defaultTitle' => $defaultTitle,
                            'defaultSubtitle' => $defaultSubtitle ?? null,
                        ])
                    </div>
                </div>
            </div>

            <div class="testi-mockup wow fadeInUp" data-wow-delay="0.1s">
                <div class="laptop-screen">
                    <div class="laptop-browser-bar">
                        <span class="dot dot-red"></span>
                        <span class="dot dot-yellow"></span>
                        <span class="dot dot-green"></span>
                        <span class="laptop-url">{{ config('constants.BRAND_NAME') }}/reviews</span>
                    </div>
                    <div class="laptop-screen-glass testi-glass">
                        <div class="laptop-shine"></div>
                        <div class="testimonials-carousel owl-carousel owl-theme">

                            @foreach ($testimonials as $testimonial)
                                <div class="testimonial">
                                    <div class="testimonial-img">
                                        <img src="{{ \App\Helper::img($testimonial->photo) }}"
                                            alt="{{ $testimonial->name }}">
                                    </div>
                                    <blockquote>
                                        <p>
                                            {{ $testimonial->message }}
                                        </p>
                                        <footer>
                                            <strong>{{ $testimonial->name }}</strong><br>
                                            <cite>{{ $testimonial->designation }}{{ $testimonial->company ? ', ' . $testimonial->company : '' }}</cite>
                                        </footer>
                                    </blockquote>
                                </div>
                            @endforeach

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
@endif
