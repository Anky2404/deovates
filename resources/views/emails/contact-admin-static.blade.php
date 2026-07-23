<div style="text-align:center; font-size:42px; line-height:1; margin-bottom:6px;">📧</div>

<h2 style="margin:0 0 16px; color:#0B3C8A; text-align:center;">New Contact Enquiry</h2>

<p>A new enquiry was submitted on {{ config('constants.BUSINESS.name') }}.</p>

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse; margin:20px 0; border-radius:8px; overflow:hidden;">
    <tr style="background:#0B3C8A;">
        <td style="padding:10px 16px; color:#ffffff; font-weight:600; font-size:14px; width:140px;">Field</td>
        <td style="padding:10px 16px; color:#ffffff; font-weight:600; font-size:14px;">Details</td>
    </tr>
    <tr style="background:#f5f8fd;">
        <td style="padding:10px 16px; color:#333333;">Name</td>
        <td style="padding:10px 16px; color:#333333;">{{ $enquiry->name }}</td>
    </tr>
    <tr style="background:#ffffff;">
        <td style="padding:10px 16px; color:#333333;">Email</td>
        <td style="padding:10px 16px; color:#333333;">{{ $enquiry->email }}</td>
    </tr>
    <tr style="background:#f5f8fd;">
        <td style="padding:10px 16px; color:#333333;">Phone</td>
        <td style="padding:10px 16px; color:#333333;">{{ $enquiry->phone ?: '—' }}</td>
    </tr>
    <tr style="background:#ffffff;">
        <td style="padding:10px 16px; color:#333333;">Subject</td>
        <td style="padding:10px 16px; color:#333333;">{{ $enquiry->subject ?: '—' }}</td>
    </tr>
</table>

<h4 style="margin:0 0 10px; color:#0B3C8A;">Message</h4>
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse; margin:0 0 20px; border-radius:8px; overflow:hidden;">
    <tr style="background:#f5f8fd;">
        <td style="padding:14px 16px; color:#333333;">{{ $enquiry->message }}</td>
    </tr>
</table>

<p>View and manage this enquiry from the admin panel.</p>
