<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #ED078B 0%, #423F8D 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        .email-body {
            padding: 30px;
        }
        .contact-info {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .contact-info h3 {
            color: #423F8D;
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 18px;
        }
        .info-row {
            display: flex;
            margin-bottom: 10px;
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 10px;
        }
        .info-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .info-label {
            font-weight: 600;
            color: #423F8D;
            width: 120px;
            flex-shrink: 0;
        }
        .info-value {
            color: #555;
        }
        .message-section {
            background-color: #fff;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }
        .message-section h4 {
            color: #423F8D;
            margin-top: 0;
            margin-bottom: 15px;
        }
        .message-content {
            color: #555;
            line-height: 1.7;
            white-space: pre-line;
        }
        .email-footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
        .logo {
            color: #ED078B;
            font-weight: 700;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>New Contact Form Submission</h1>
            <p style="margin: 5px 0 0 0; opacity: 0.9;">From OSPTA Website</p>
        </div>
        
        <div class="email-body">
            <div class="contact-info">
                <h3>Contact Information</h3>
                
                <div class="info-row">
                    <div class="info-label">Name:</div>
                    <div class="info-value">{{ $contactData['name'] }}</div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Email:</div>
                    <div class="info-value">{{ $contactData['email'] }}</div>
                </div>
                
                @if(!empty($contactData['phone']))
                <div class="info-row">
                    <div class="info-label">Phone:</div>
                    <div class="info-value">{{ $contactData['phone'] }}</div>
                </div>
                @endif
                
                <div class="info-row">
                    <div class="info-label">Subject:</div>
                    <div class="info-value">{{ $contactData['subject'] }}</div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Submitted:</div>
                    <div class="info-value">{{ date('F j, Y \a\t g:i A') }}</div>
                </div>
            </div>
            
            <div class="message-section">
                <h4>Message</h4>
                <div class="message-content">{{ $contactData['message'] }}</div>
            </div>
        </div>
        
        <div class="email-footer">
            <div class="logo">OSPTA</div>
            <p style="margin: 10px 0 0 0;">This email was sent from the contact form on your website.</p>
        </div>
    </div>
</body>
</html>
