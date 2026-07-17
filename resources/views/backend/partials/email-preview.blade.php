{{-- Reusable "envelope opens into a desktop preview" component.
     Usage: @include('backend.partials.email-preview', [
         'previewId'   => 'templatePreview',   // unique per instance on the page
         'previewHtml' => $renderedHtml,        // full rendered email HTML (emails.layout output)
     ])
--}}
<div class="email-envelope-wrap" id="{{ $previewId }}Wrap">

    {{-- CLOSED STATE: envelope + open button --}}
    <div class="email-envelope-stage" id="{{ $previewId }}Stage">
        <div class="email-envelope">
            <div class="email-envelope-flap"></div>
            <div class="email-envelope-body"></div>
            <div class="email-envelope-heart">
                <i class="bx bx-envelope"></i>
            </div>
        </div>

        <button type="button" class="btn btn-primary mt-4 email-open-btn" data-target="{{ $previewId }}">
            <i class="bx bx-mail-send me-1"></i> Open Email
        </button>
    </div>

    {{-- OPEN STATE: device mockup with the real rendered email — a
         browser-window chrome on desktop, a phone chrome on mobile,
         swapped purely by viewport width (same iframe content either way). --}}
    <div class="email-open-mockup d-none" id="{{ $previewId }}Desktop">

        {{-- Desktop chrome: browser window --}}
        <div class="email-desktop-frame d-none d-sm-block">
            <div class="email-desktop-bar">
                <span class="email-desktop-dot" style="background:#ff5f56;"></span>
                <span class="email-desktop-dot" style="background:#ffbd2e;"></span>
                <span class="email-desktop-dot" style="background:#27c93f;"></span>
                <span class="email-desktop-url">mail &mdash; {{ config('constants.BUSINESS.name') }}</span>
                <button type="button" class="btn btn-sm btn-outline-secondary ms-auto email-close-btn" data-target="{{ $previewId }}">
                    <i class="bx bx-x"></i> Close
                </button>
            </div>
            <iframe id="{{ $previewId }}IframeDesktop" class="email-desktop-iframe email-preview-iframe" title="Email preview (desktop)"
                    @if ($alwaysRefresh ?? false) data-always-refresh="true" @endif></iframe>
        </div>

        {{-- Mobile chrome: phone frame --}}
        <div class="email-phone-frame d-sm-none">
            <button type="button" class="btn btn-sm btn-outline-secondary email-close-btn email-close-btn-mobile" data-target="{{ $previewId }}">
                <i class="bx bx-x"></i> Close
            </button>
            <div class="email-phone-shell">
                <div class="email-phone-notch"></div>
                <iframe id="{{ $previewId }}IframeMobile" class="email-phone-iframe email-preview-iframe" title="Email preview (mobile)"
                        @if ($alwaysRefresh ?? false) data-always-refresh="true" @endif></iframe>
                <div class="email-phone-home"></div>
            </div>
        </div>

    </div>

</div>

@once
<style>
    .email-envelope-wrap {
        display: flex;
        justify-content: center;
        padding: 30px 0;
    }

    .email-envelope-stage {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .email-envelope {
        position: relative;
        width: 220px;
        height: 140px;
    }

    .email-envelope-body {
        position: absolute;
        inset: 0;
        background: #eef2ff;
        border: 2px solid #696cff;
        border-radius: 6px;
    }

    .email-envelope-flap {
        position: absolute;
        top: 0;
        left: 0;
        width: 0;
        height: 0;
        border-left: 110px solid transparent;
        border-right: 110px solid transparent;
        border-top: 70px solid #696cff;
        transform-origin: top center;
        transition: transform 0.6s ease;
        z-index: 2;
    }

    .email-envelope-heart {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -20%);
        font-size: 28px;
        color: #696cff;
        z-index: 1;
    }

    .email-envelope.is-open .email-envelope-flap {
        transform: rotateX(150deg);
    }

    .email-open-mockup {
        width: 100%;
        animation: emailDesktopIn 0.4s ease;
    }

    .email-desktop-frame {
        max-width: 700px;
        margin: 0 auto;
        border: 1px solid #d9d9e3;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
    }

    .email-desktop-bar {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 10px 14px;
        background: #f1f1f4;
        border-bottom: 1px solid #e2e2ea;
    }

    .email-desktop-dot {
        width: 11px;
        height: 11px;
        border-radius: 50%;
        display: inline-block;
    }

    .email-desktop-url {
        margin-left: 10px;
        font-size: 12px;
        color: #6c757d;
    }

    .email-desktop-iframe {
        width: 100%;
        height: 560px;
        border: 0;
        display: block;
        background: #f2f5fa;
    }

    .email-phone-frame {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .email-close-btn-mobile {
        margin-bottom: 12px;
    }

    .email-phone-shell {
        position: relative;
        width: 280px;
        height: 560px;
        background: #1c1c1e;
        border-radius: 34px;
        padding: 12px 8px;
        box-shadow: 0 16px 34px rgba(0, 0, 0, 0.18);
    }

    .email-phone-notch {
        position: absolute;
        top: 12px;
        left: 50%;
        transform: translateX(-50%);
        width: 90px;
        height: 16px;
        background: #1c1c1e;
        border-radius: 0 0 10px 10px;
        z-index: 2;
    }

    .email-phone-iframe {
        width: 100%;
        height: 100%;
        border: 0;
        border-radius: 22px;
        background: #f2f5fa;
        display: block;
    }

    .email-phone-home {
        position: absolute;
        bottom: 8px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: #4a4a4c;
        border-radius: 2px;
    }

    @keyframes emailDesktopIn {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.body.addEventListener('click', function (event) {
        const openBtn = event.target.closest('.email-open-btn');
        const closeBtn = event.target.closest('.email-close-btn');

        if (openBtn) {
            const id = openBtn.dataset.target;
            const stage = document.getElementById(id + 'Stage');
            const desktop = document.getElementById(id + 'Desktop');
            const envelope = stage?.querySelector('.email-envelope');

            envelope?.classList.add('is-open');

            setTimeout(function () {
                if (stage) stage.classList.add('d-none');
                if (desktop) desktop.classList.remove('d-none');

                desktop?.querySelectorAll('.email-preview-iframe').forEach(function (iframe) {
                    if (iframe.dataset.html && (!iframe.dataset.loaded || iframe.dataset.alwaysRefresh)) {
                        iframe.srcdoc = iframe.dataset.html;
                        iframe.dataset.loaded = '1';
                    }
                });
            }, 500);
        }

        if (closeBtn) {
            const id = closeBtn.dataset.target;
            const stage = document.getElementById(id + 'Stage');
            const desktop = document.getElementById(id + 'Desktop');
            const envelope = stage?.querySelector('.email-envelope');

            desktop?.classList.add('d-none');
            stage?.classList.remove('d-none');
            envelope?.classList.remove('is-open');
        }
    });
});
</script>
@endonce

<script>
    (function () {
        const html = @json($previewHtml);
        const desktopFrame = document.getElementById('{{ $previewId }}IframeDesktop');
        const mobileFrame = document.getElementById('{{ $previewId }}IframeMobile');

        if (desktopFrame) desktopFrame.dataset.html = html;
        if (mobileFrame) mobileFrame.dataset.html = html;
    })();
</script>
