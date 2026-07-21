{{--
    Shared "FAQ + Contact" block — reused as-is across Home, About,
    Services, Blog, FAQ, and Testimonials (all point at the same
    `faq-section` Section for the heading; each page's own $category
    supplies the actual Q&A list).

    Params:
    - $page             App\Models\Page|null
    - $sectionContents  array [section_id => data]
    - $category         FaqCategory|null — with activeFaqs eager-loaded
    - $defaultTitle     string — page-specific fallback title
    - $defaultSubtitle  string|null — page-specific fallback subtitle
--}}
@php
    $__faqSection = $page?->sections->firstWhere('slug', 'faq-section');
    $__faqContent = $__faqSection ? ($sectionContents[$__faqSection->id] ?? []) : [];
@endphp
<section id="faq-section" class="faq-section">
    <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="section-title st-center">
                    @include('front.partials._section_heading', [
                        'content' => $__faqContent,
                        'defaultTitle' => $defaultTitle,
                        'defaultSubtitle' => $defaultSubtitle ?? null,
                    ])
                </div>
            </div>
        </div>

        <div class="faq-contact-grid">

            <!-- LEFT: FAQ app tablet -->
            <div class="faq-tablet-col wow fadeInLeft" data-wow-delay="0.1s">
                <div class="app-tablet">
                    <div class="tablet-frame app-tablet-frame">
                        <div class="tablet-cam"></div>
                        <div class="tablet-screen app-tablet-screen">
                            <div class="tablet-statusbar">
                                <span class="phone-brand">{{ config('constants.BRAND_NAME') }}</span>
                            </div>

                            <div class="app-screen-header">
                                <h4>FAQs</h4>
                                <p>Quick answers to common questions</p>
                            </div>

                            <div class="faq-wrapper app-faq-list">

                                @forelse ($category->activeFaqs ?? [] as $faq)
                                    <div class="faq-item @if ($loop->first) active @endif">
                                        <div class="faq-title">
                                            <h5>{{ $faq->question }}</h5>
                                            <span class="faq-icon">
                                                <i class="fa fa-{{ $loop->first ? 'minus' : 'plus' }}"></i>
                                            </span>
                                        </div>

                                        <div class="faq-content"
                                            @if ($loop->first) style="display:block;" @endif>
                                            <p>
                                                {{ $faq->answer }}
                                            </p>
                                        </div>
                                    </div>
                                @empty
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
                                @endforelse

                            </div>
                        </div>
                        <div class="tablet-home-btn"></div>
                    </div>
                    <div class="tablet-shadow"></div>
                </div>
            </div>

            <!-- RIGHT: Contact form tablet -->
            <div class="contact-tablet-col wow fadeInRight" data-wow-delay="0.2s">
                <div class="app-tablet">
                    <div class="tablet-frame app-tablet-frame">
                        <div class="tablet-cam"></div>
                        <div class="tablet-screen app-tablet-screen">
                            <div class="tablet-statusbar">
                                <span class="phone-brand">{{ config('constants.BRAND_NAME') }}</span>
                            </div>

                            <div class="app-screen-header">
                                <h4>Get In Touch</h4>
                                <p>We'd love to hear about your project</p>
                            </div>
                            @include('front.common.contact-form')
                        </div>
                        <div class="tablet-home-btn"></div>
                    </div>
                    <div class="tablet-shadow"></div>
                </div>
            </div>

        </div>

    </div>
</section>
