<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body style="font-family: Arial, sans-serif; color:#1a2b3c; line-height:1.6;">
    <h2 style="color:#0f2a4a; margin-bottom:4px;">New Contact Form Submission</h2>
    <p style="color:#5b6b7c; margin-top:0;">Sewgo website — /contact</p>

    <table cellpadding="6" cellspacing="0" style="border-collapse:collapse; width:100%; max-width:560px;">
        <tr><td style="font-weight:bold; width:150px; vertical-align:top;">Name</td><td>{{ $data['first_name'] }} {{ $data['last_name'] }}</td></tr>
        <tr><td style="font-weight:bold; vertical-align:top;">Work Email</td><td>{{ $data['work_email'] }}</td></tr>
        <tr><td style="font-weight:bold; vertical-align:top;">Phone</td><td>{{ $data['phone'] ?? '—' }}@if(!empty($data['ext'])) ext. {{ $data['ext'] }}@endif</td></tr>
        <tr><td style="font-weight:bold; vertical-align:top;">Company</td><td>{{ $data['company'] }}</td></tr>
        <tr><td style="font-weight:bold; vertical-align:top;">Website</td><td>{{ $data['website'] ?? '—' }}</td></tr>
        <tr><td style="font-weight:bold; vertical-align:top;">Company Size</td><td>{{ $data['company_size'] ?? '—' }}</td></tr>
        <tr><td style="font-weight:bold; vertical-align:top;">How they heard about us</td><td>{{ $data['learned_from'] ?? '—' }}</td></tr>
        <tr><td style="font-weight:bold; vertical-align:top;">Message</td><td>{{ $data['message'] ?? '—' }}</td></tr>
    </table>
</body>
</html>
