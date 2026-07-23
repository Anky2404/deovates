<div style="text-align:center; font-size:42px; line-height:1; margin-bottom:6px;">📧</div>

<h2 style="margin:0 0 16px; color:#0B3C8A; text-align:center;">Thanks for reaching out, {{ $enquiry->name }}!</h2>

<p>We've received your message regarding <strong>{{ $enquiry->subject ?: 'your enquiry' }}</strong> and our team will get back to you shortly.</p>

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse; margin:20px 0; border-radius:8px; overflow:hidden;">
    <tr style="background:#0B3C8A;">
        <td style="padding:10px 16px; color:#ffffff; font-weight:600; font-size:14px;">Your Message</td>
    </tr>
    <tr style="background:#f5f8fd;">
        <td style="padding:14px 16px; color:#333333;">{{ $enquiry->message }}</td>
    </tr>
</table>

<p>We usually respond within a few hours on working days.</p>

<p>Best regards,<br>{{ config('constants.BUSINESS.name') }} Team</p>
