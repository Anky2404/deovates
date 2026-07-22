{{--
    Shared "Call to Action" block — reused as-is across Home, About,
    Services, Blog, FAQ, and Testimonials (all point at the same
    `cta-section` Section, so one admin edit updates every page that hasn't
    overridden it, per-page, on its own PageSectionContent row).

    Params:
    - $page             App\Models\Page|null — the current page, with
                         sections eager-loaded
    - $sectionContents  array [section_id => data]
    - $defaultTitle     string — page-specific fallback title
    - $defaultSubtitle  string|null — page-specific fallback subtitle
--}}
@php
    $__ctaSection = $page?->sections->firstWhere('slug', 'cta-section');
    $__ctaContent = $__ctaSection ? ($sectionContents[$__ctaSection->id] ?? []) : [];
@endphp
<section class="call-2-acction" data-stellar-background-ratio="0.4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="section-title st-center">
                    @include('front.common._section_heading', [
                        'content' => $__ctaContent,
                        'defaultTitle' => $defaultTitle,
                        'defaultSubtitle' => $defaultSubtitle ?? null,
                    ])
                </div>

                <div class="c2a">

                    <p>
                        @if (!empty($__ctaContent['cta_paragraph']))
                            {!! $__ctaContent['cta_paragraph'] !!}
                        @else
                            Whether you're launching a startup, modernizing your business, or scaling your digital presence,
                            {{ config('constants.BUSINESS.name') }} delivers custom websites, business software, eCommerce platforms, and innovative
                            technology solutions tailored to your goals. Partner with our experienced team to build secure,
                            scalable, and high-performing digital products that create lasting business value.
                        @endif
                    </p>

                    <a href="{{ $__ctaContent['btn_links'] ?? route('front.contact.index') }}" class="btn btn-main btn-lg">
                        {{ $__ctaContent['btn_text'] ?? 'Start Your Project' }}
                    </a>

                </div>

            </div>
        </div>
    </div>
</section>
