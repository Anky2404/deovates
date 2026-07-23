{{--
    Fixed floating widgets shown on every front-end page:
    - WhatsApp button, sits just above the Tawk.to launcher so the two never
      overlap.
    - Tawk.to live chat, only rendered once both IDs are configured in
      config/constants.php (via TAWK_TO_PROPERTY_ID / TAWK_TO_WIDGET_ID in
      .env) — kept out entirely rather than emitting a script tag that would
      fail to load against an empty property id.
--}}
@php
    $tawkPropertyId = config('constants.TAWK_TO.property_id');
    $tawkWidgetId = config('constants.TAWK_TO.widget_id');
    $tawkEnabled = !empty($tawkPropertyId) && !empty($tawkWidgetId);
    $meetingUrl = config('constants.CONTACT.meeting_url');
@endphp

@if ($meetingUrl)
    <a href="{{ $meetingUrl }}" target="_blank" rel="noopener" class="floating-meeting-btn" aria-label="Schedule a meeting">
        <i class="fas fa-calendar-check"></i>
        <span>Book a Meeting</span>
    </a>
@endif

<a href="{{ config('constants.CONTACT.whatsapp.link') }}" target="_blank" rel="noopener" class="floating-whatsapp-btn" aria-label="Chat with us on WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>

<style>
    .floating-whatsapp-btn {
        position: fixed;
        right: 24px;
        bottom: 96px;
        z-index: 9998;
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: #25D366;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
        transition: transform .2s ease, box-shadow .2s ease;
        animation: floatingWhatsappPulse 2.4s ease-in-out infinite;
    }
    .floating-whatsapp-btn:hover {
        color: #fff;
        transform: scale(1.08);
        box-shadow: 0 10px 28px rgba(0, 0, 0, 0.32);
    }
    @keyframes floatingWhatsappPulse {
        0%, 100% { box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25), 0 0 0 0 rgba(37, 211, 102, 0.5); }
        50% { box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25), 0 0 0 10px rgba(37, 211, 102, 0); }
    }

    @media (max-width: 575px) {
        .floating-whatsapp-btn {
            right: 16px;
            bottom: 86px;
            width: 50px;
            height: 50px;
            font-size: 26px;
        }
    }

    .floating-meeting-btn {
        position: fixed;
        right: 24px;
        bottom: 166px;
        z-index: 9998;
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 12px 18px;
        border-radius: 50px;
        background: #0B3C8A;
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        box-shadow: 0 8px 24px rgba(11, 60, 138, 0.35);
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .floating-meeting-btn:hover {
        color: #fff;
        transform: scale(1.05);
        box-shadow: 0 10px 28px rgba(11, 60, 138, 0.45);
    }
    .floating-meeting-btn i {
        font-size: 18px;
    }

    @media (max-width: 575px) {
        .floating-meeting-btn {
            right: 16px;
            bottom: 146px;
            padding: 10px 14px;
            font-size: 12px;
        }
        .floating-meeting-btn span {
            display: none;
        }
    }
</style>

@if ($tawkEnabled)
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {};
        var Tawk_LoadStart = new Date();
        (function () {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/{{ $tawkPropertyId }}/{{ $tawkWidgetId }}';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
@endif
