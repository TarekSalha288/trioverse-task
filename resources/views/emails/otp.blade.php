<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Code (OTP)</title>
    <style>
        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
            direction: ltr;
            text-align: left;
        }
        .email-container {
            max-width: 500px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid #eef2f5;
        }
        .header {
            background-color: #4f46e5; /* Indigo */
            padding: 30px;
            text-align: center;
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .content {
            padding: 40px 30px;
            color: #334155;
            line-height: 1.6;
        }
        .content p {
            font-size: 15px;
            margin-bottom: 25px;
        }
        .otp-container {
            background-color: #f8fafc;
            border: 2px dashed #cbd5e1;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin: 30px 0;
        }
        .otp-code {
            font-size: 32px;
            font-weight: 700;
            letter-spacing: 6px;
            color: #1e1b4b;
            font-family: monospace, sans-serif;
        }
        .footer {
            background-color: #f8fafc;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
            border-top: 1px solid #eef2f5;
        }
        .warning {
            font-size: 13px;
            color: #94a3b8;
            margin-top: 25px;
            border-top: 1px solid #f1f5f9;
            padding-top: 15px;
        }
    </style>
</head>
<body>

    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>Identity Verification</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Hello,</p>
            <p>We received a request to log in or perform a secure action on your account. Please use the following One-Time Password (OTP) to complete the process:</p>

            <!-- OTP Box -->
            <div class="otp-container">
                <div class="otp-code">{{$otp}}</div>
            </div>

            <p>This verification code is valid for the next 10 minutes.</p>

            <div class="warning">
                If you did not request this code, please ignore this email and ensure your account password is secure.
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            &copy; {{ date('Y') }} Support Ticket System. All rights reserved.
        </div>
    </div>

</body>
</html>
