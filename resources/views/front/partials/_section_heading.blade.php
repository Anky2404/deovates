{{--
    Shared section-title block: optional orange label + title + subtitle,
    sourced from a Section's PageSectionContent with fallback to the
    legacy static Helper::sectionTitle() JSON data.

    Params:
    - $content         array, PageSectionContent->data (or [])
    - $defaultTitle    string, fallback title
    - $defaultSubtitle string, optional fallback subtitle
    - $tag             string, optional heading tag (default 'h3')
--}}
@php
    $content = $content ?? [];
    $tag = $tag ?? 'h3';
    $title = $content['section_title'] ?? ($defaultTitle ?? '');
    $subtitle = $content['section_subtitle'] ?? ($defaultSubtitle ?? '');
@endphp

@if(!empty($content['section_label']))
    <span class="sub-title d-block fw-semibold" style="color:#ff5f13;">{{ $content['section_label'] }}</span>
@endif

<{{ $tag }}>{{ $title }}</{{ $tag }}>

@if(!empty($subtitle))
    <p>{{ $subtitle }}</p>
@endif
