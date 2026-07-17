<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $subject ?? config('constants.BUSINESS.name') }}</title>
</head>
<body style="margin:0; padding:0; background:#f2f5fa; font-family:Arial, Helvetica, sans-serif;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f2f5fa; padding:30px 0;">
    <tr>
        <td align="center">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
                   style="max-width:650px; margin:auto; background:#ffffff; border-radius:8px; overflow:hidden;">

                {{-- HEADER --}}
                <tr>
                    <td style="background:#0B3C8A; color:#ffffff; padding:35px 30px; text-align:center;">
                        <img src="{{ asset(config('constants.CONFIG.logo.header')) }}" height="48" alt="{{ config('constants.BUSINESS.name') }}"
                             style="height:48px; margin-bottom:12px;">
                        <h2 style="margin:0; font-size:22px; font-weight:600; color:#ffffff;">
                            {{ config('constants.BUSINESS.name') }}
                        </h2>
                    </td>
                </tr>

                {{-- BODY --}}
                <tr>
                    <td style="padding:40px 35px; color:#4a5568; font-size:16px; line-height:1.8;">
                        {!! $body !!}
                    </td>
                </tr>

                {{-- CTA --}}
                <tr>
                    <td style="padding:0 35px 35px; text-align:center;">
                        <a href="{{ url('/') }}"
                           style="background:#0B3C8A; color:#ffffff; padding:14px 32px; text-decoration:none; border-radius:6px; font-weight:600; display:inline-block;">
                            Visit Website
                        </a>
                    </td>
                </tr>

                {{-- FOOTER --}}
                <tr>
                    <td style="background:#f2f5fa; padding:28px 30px; text-align:center; font-size:13px; color:#6c757d;">
                        <p style="margin:0 0 8px;">&copy; {{ date('Y') }} {{ config('constants.BUSINESS.name') }}. All rights reserved.</p>
                        <p style="margin:0 0 12px;">This email was sent automatically. If you did not expect this, you can ignore it.</p>
                        <div>
                            <a href="{{ url('/') }}" style="color:#0B3C8A; text-decoration:none; margin:0 8px;">Website</a>
                            <a href="{{ route('front.contact.index') }}" style="color:#0B3C8A; text-decoration:none; margin:0 8px;">Contact</a>
                            <a href="{{ route('front.legal.privacy') }}" style="color:#0B3C8A; text-decoration:none; margin:0 8px;">Privacy</a>
                        </div>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>
</body>
</html>
