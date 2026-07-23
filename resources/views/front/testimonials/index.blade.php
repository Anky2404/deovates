@extends('front.layouts.app')

@section('title', config('constants.PAGE_SEO.testimonials.title'))
@section('meta_description', config('constants.PAGE_SEO.testimonials.meta_description'))
@section('meta_keywords', config('constants.PAGE_SEO.testimonials.meta_keywords'))
@section('content')

    <!-- Start Hero Section -->
    <!-- Hero -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ \App\Helper::heroBanner('testimonials.avif', 'assets/front/img/hero/h2_hero.avif') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>Client Testimonials</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Testimonials</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Client Testimonials Section -->
    <!-- Testimonials -->
    @php
        $testimonialsListingSection = $page?->sections->firstWhere('slug', 'testimonials-page-listing-section');
        $testimonialsListingContent = $testimonialsListingSection ? $sectionContents[$testimonialsListingSection->id] ?? [] : [];
    @endphp
    @if ($testimonials->isNotEmpty())
    <section class="testimonials">

        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center">
                        @include('front.common._section_heading', [
                            'content' => $testimonialsListingContent,
                            'defaultTitle' => \App\Helper::sectionTitle('testimonials', 'listing', 'title', 'What Our Clients Say'),
                            'defaultSubtitle' => \App\Helper::sectionTitle('testimonials', 'listing', 'subtitle'),
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
                                        <img src="{{ \App\Helper::img($testimonial->photo) }}" alt="{{ $testimonial->name }}">
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
    <!-- End Client Testimonials Section -->

    @if ($googleReviews->isNotEmpty())
    <!-- Start Google Reviews Section -->
    <section class="google-reviews-section py-5">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center">
                        <span class="sub-title">Verified on Google</span>
                        <h3>What People Say on Google</h3>

                        @if ($googleRating)
                            <div class="google-reviews-summary">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" alt="Google" class="google-reviews-glogo">
                                <span class="google-reviews-score">{{ number_format($googleRating, 1) }}</span>
                                <span class="google-reviews-stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="bx {{ $i <= round($googleRating) ? 'bxs-star' : 'bx-star' }}"></i>
                                    @endfor
                                </span>
                                @if ($googleTotalCount)
                                    <span class="google-reviews-count">Based on {{ number_format($googleTotalCount) }} Google reviews</span>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row g-4">
                @foreach ($googleReviews as $review)
                    <div class="col-md-6 col-lg-4">
                        <div class="google-review-card">
                            <div class="google-review-head">
                                <img src="{{ $review->author_photo_url ?: asset('assets/front/img/default-img.avif') }}"
                                     alt="{{ $review->author_name }}" class="google-review-avatar">
                                <div>
                                    <strong>{{ $review->author_name }}</strong>
                                    <div class="google-review-stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="bx {{ $i <= $review->rating ? 'bxs-star' : 'bx-star' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                                <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg"
                                     alt="Google" class="google-review-badge">
                            </div>

                            @if ($review->review_text)
                                <p class="google-review-text">{{ \Illuminate\Support\Str::limit($review->review_text, 220) }}</p>
                            @endif

                            <div class="google-review-time">{{ $review->relative_time_description }}</div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
    <!-- End Google Reviews Section -->
    @endif

    @if (config('constants.ELFSIGHT_WIDGET_ID'))
    <!-- Start Elfsight Google Reviews Widget -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center mb-4">
                        <span class="sub-title">Verified on Google</span>
                        <h3>What People Say on Google</h3>
                    </div>
                </div>
            </div>

            <div class="elfsight-app-{{ config('constants.ELFSIGHT_WIDGET_ID') }}" id="elfsightGoogleReviewsWidget" data-elfsight-app-lazy></div>
        </div>
    </section>
    <!-- End Elfsight Google Reviews Widget -->

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        {{--
            Best-effort scrape of the Elfsight widget's own rendered DOM
            (NOT Google's servers — this only reads content Elfsight
            already displays on our page) so a copy lands in our database.
            Explicitly approved despite the risk: Elfsight's internal
            markup isn't a public API and can change without notice,
            silently breaking this. If nothing ever gets captured, open
            DevTools on this page, inspect one review card inside
            #elfsightGoogleReviewsWidget, and adjust the selectors below
            to match what's actually there.
        --}}
        var widget = document.getElementById('elfsightGoogleReviewsWidget');
        if (!widget) return;

        var captured = false;
        var csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        function looksLikeReviewCard(el) {
            var text = (el.innerText || '').trim();
            return text.length > 20 && text.length < 2000;
        }

        function extractRating(card) {
            // Count filled/active star-like icons; Elfsight commonly marks
            // filled stars with a class containing "active" or "filled",
            // or renders inline SVG stars — fall back to counting any
            // element whose class mentions "star".
            var filled = card.querySelectorAll('[class*="star"][class*="active"], [class*="star"][class*="filled"], [class*="Star"][class*="active"]');
            if (filled.length >= 1 && filled.length <= 5) return filled.length;

            var anyStars = card.querySelectorAll('[class*="star" i]');
            if (anyStars.length >= 1 && anyStars.length <= 5) return anyStars.length;

            return 5;
        }

        function extractReviews() {
            if (captured) return;

            // Elfsight typically wraps each review in a repeated card-like
            // element; look for common naming patterns first, then fall
            // back to any direct-children group that repeats 2+ times.
            var cardSelectors = [
                '[class*="review-item" i]',
                '[class*="reviewCard" i]',
                '[class*="review-card" i]',
                '[class*="testimonial-item" i]',
                '[class*="Item"][class*="review" i]'
            ];

            var cards = [];
            for (var i = 0; i < cardSelectors.length; i++) {
                var found = widget.querySelectorAll(cardSelectors[i]);
                if (found.length >= 1) {
                    cards = Array.prototype.slice.call(found);
                    break;
                }
            }

            if (!cards.length) return;

            var reviews = [];

            cards.forEach(function (card) {
                if (!looksLikeReviewCard(card)) return;

                var nameEl = card.querySelector('[class*="name" i], [class*="author" i], h3, h4, strong, b');
                var textEl = card.querySelector('[class*="text" i], [class*="content" i], [class*="body" i], p');
                var imgEl = card.querySelector('img');

                var authorName = nameEl ? nameEl.innerText.trim() : null;
                var reviewText = textEl ? textEl.innerText.trim() : card.innerText.trim();

                if (!authorName || authorName.length > 100) return;

                reviews.push({
                    author_name: authorName,
                    rating: extractRating(card),
                    review_text: reviewText.substring(0, 2000),
                    author_photo_url: imgEl ? imgEl.src : null
                });
            });

            if (!reviews.length) return;

            captured = true;

            fetch('{{ route('front.elfsight-reviews.capture') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ reviews: reviews })
            }).catch(function () {
                // Best-effort only — a failed capture never affects the
                // visible widget or the rest of the page.
            });
        }

        // The widget loads its content asynchronously from Elfsight's own
        // servers, so watch for DOM changes instead of a fixed delay.
        var observer = new MutationObserver(function () {
            extractReviews();
        });
        observer.observe(widget, { childList: true, subtree: true });

        // Safety net in case content is already there before the observer
        // attaches, and a hard stop so this never watches forever.
        setTimeout(extractReviews, 3000);
        setTimeout(function () { observer.disconnect(); }, 15000);
    });
    </script>
    @endpush

    @once
    <style>
        .google-reviews-summary {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 14px;
        }

        .google-reviews-glogo {
            width: 22px;
            height: 22px;
        }

        .google-reviews-score {
            font-size: 22px;
            font-weight: 700;
            color: #0B3C8A;
        }

        .google-reviews-stars i {
            color: #f5b400;
            font-size: 16px;
        }

        .google-reviews-stars i.bx-star {
            color: #d8dce3;
        }

        .google-reviews-count {
            font-size: 13px;
            color: #6c7688;
        }

        .google-review-card {
            height: 100%;
            padding: 22px;
            border-radius: 14px;
            background: #fff;
            border: 1px solid #eef0f4;
            box-shadow: 0 8px 24px rgba(11, 60, 138, 0.06);
        }

        .google-review-head {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .google-review-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
        }

        .google-review-badge {
            width: 18px;
            height: 18px;
            margin-left: auto;
            align-self: flex-start;
            opacity: .8;
        }

        .google-review-stars i {
            color: #f5b400;
            font-size: 13px;
        }

        .google-review-stars i.bx-star {
            color: #d8dce3;
        }

        .google-review-text {
            font-size: 14px;
            color: #4a5568;
            line-height: 1.6;
        }

        .google-review-time {
            font-size: 12px;
            color: #9aa4b4;
            margin-top: 10px;
        }

        @media (prefers-color-scheme: dark) {
            .google-review-card {
                background: rgba(255, 255, 255, 0.03);
                border-color: rgba(255, 255, 255, 0.08);
            }

            .google-review-text {
                color: #c3cad6;
            }
        }
    </style>
    @endonce
    @endif

    <!-- Start CTA Section -->
    <!-- CTA -->
    @include('front.common._cta_section', [
        'page' => $page,
        'sectionContents' => $sectionContents,
        'defaultTitle' => \App\Helper::sectionTitle('testimonials', 'cta', 'title', "LET'S BUILD SOMETHING EXCEPTIONAL"),
        'defaultSubtitle' => \App\Helper::sectionTitle('testimonials', 'cta', 'subtitle'),
    ])
    <!-- End CTA Section -->

    <!-- Start FAQ Section -->
    @include('front.common._faq_section', [
        'page' => $page,
        'sectionContents' => $sectionContents,
        'category' => $category,
        'defaultTitle' => \App\Helper::sectionTitle('testimonials', 'faq', 'title', 'Frequently Asked Questions'),
        'defaultSubtitle' => \App\Helper::sectionTitle('testimonials', 'faq', 'subtitle'),
    ])
    <!-- End FAQ Section -->


@endsection
