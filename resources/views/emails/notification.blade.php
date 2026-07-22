{{--
    Single shared email body builder — every notification email in the app
    (password reset, contact, career applications, enquiry status,
    newsletter) renders through this one view instead of a separate
    "-fallback" blade file per email type. The structure (which sections
    appear) is decided here, once, when a template's default row is first
    seeded into the database; the @{{placeholder}} tokens left in the
    output are substituted with real values later, on every send, by
    EmailTemplate::render(). After that, admins edit the stored HTML
    directly from Admin > Emails > Templates — this view is never touched
    again for that template.
--}}
<h2 style="margin:0 0 16px; color:#0B3C8A;">{!! $greeting ?? 'Hi @{{name}},' !!}</h2>

@if (!empty($intro))
    <p>{!! $intro !!}</p>
@endif

@if (!empty($fields))
    <table style="width:100%; border-collapse:collapse; margin:16px 0;">
        @foreach ($fields as $label => $token)
            <tr>
                <td style="padding:6px 0; color:#666; width:140px;">{{ $label }}</td>
                <td style="padding:6px 0; color:#111;">{!! $token !!}</td>
            </tr>
        @endforeach
    </table>
@endif

@if (!empty($quote))
    <p style="background:#f5f8fd; border-left:3px solid #0B3C8A; padding:12px 16px; margin:20px 0; color:#333;">
        {!! $quote !!}
    </p>
@endif

@if (!empty($button))
    <p style="text-align:center; margin:28px 0;">
        <a href="{!! $button['url'] !!}"
           style="background:#0B3C8A; color:#ffffff; padding:14px 32px; text-decoration:none; border-radius:6px; font-weight:600; display:inline-block;">
            {{ $button['text'] }}
        </a>
    </p>
@endif

@if (!empty($outro))
    <p>{!! $outro !!}</p>
@endif

@php
    $signoff = $signoff ?? 'Best regards,<br>{{app_name}} Team';
@endphp

@if (!empty($signoff))
    <p>{!! $signoff !!}</p>
@endif
