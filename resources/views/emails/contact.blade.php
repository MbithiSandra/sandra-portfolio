<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .card { background: #ffffff; border-radius: 12px; padding: 32px; max-width: 560px; margin: 0 auto; }
        .badge { display: inline-block; background: #6c3bff; color: white; padding: 4px 12px; border-radius: 100px; font-size: 12px; margin-bottom: 24px; }
        h2 { color: #0a0a0a; margin: 0 0 24px; font-size: 20px; }
        .field { margin-bottom: 16px; }
        .label { font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #888; margin-bottom: 4px; }
        .value { color: #0a0a0a; font-size: 15px; }
        .message-box { background: #f8f8f8; border-left: 3px solid #6c3bff; padding: 16px; border-radius: 4px; margin-top: 8px; }
        .footer { text-align: center; color: #aaa; font-size: 12px; margin-top: 24px; }
    </style>
</head>
<body>
    <div class="card">
        <div class="badge">New {{ $messageType }}</div>
        <h2>Someone reached out via your portfolio</h2>

        <div class="field">
            <div class="label">From</div>
            <div class="value">{{ $senderName }}</div>
        </div>

        <div class="field">
            <div class="label">Email</div>
            <div class="value">{{ $senderEmail }}</div>
        </div>

        <div class="field">
            <div class="label">Subject</div>
            <div class="value">{{ $emailSubject }}</div>
        </div>

        <div class="field">
            <div class="label">Message</div>
            <div class="message-box">{{ $messageBody }}</div>
        </div>

        <div class="footer">Sent from Sandra Mbithi's Portfolio · {{ date('Y') }}</div>
    </div>
</body>
</html>