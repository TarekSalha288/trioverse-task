<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Ticket Notification</title>
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
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid #eef2f5;
        }
        .header {
            background-color: #0f172a; /* Slate Dark Professional color */
            padding: 30px;
            text-align: center;
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .badge {
            display: inline-block;
            background-color: #ef4444; /* Red badge for urgency */
            color: white;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: bold;
            margin-top: 10px;
            text-transform: uppercase;
        }
        .content {
            padding: 40px 30px;
            color: #334155;
            line-height: 1.6;
        }
        .content p {
            font-size: 16px;
            margin-top: 0;
            margin-bottom: 20px;
        }
        .ticket-details {
            background-color: #f8fafc;
            border-left: 4px solid #4f46e5; /* Indigo accent line */
            padding: 20px;
            border-radius: 0 8px 8px 0;
            margin: 25px 0;
        }
        .detail-row {
            margin-bottom: 12px;
            font-size: 14px;
        }
        .detail-row:last-child {
            margin-bottom: 0;
        }
        .label {
            font-weight: 700;
            color: #64748b;
            min-width: 90px;
            display: inline-block;
        }
        .value {
            color: #0f172a;
        }
        .ticket-body {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 15px;
            margin-top: 10px;
            font-style: italic;
            color: #475569;
        }
        .action-container {
            text-align: center;
            margin: 35px 0 15px 0;
        }
        .btn {
            background-color: #4f46e5;
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            display: inline-block;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
        }
        .btn:hover {
            background-color: #4338ca;
        }
        .footer {
            background-color: #f8fafc;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
            border-top: 1px solid #eef2f5;
        }
    </style>
</head>
<body>

    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>New Ticket Assigned</h1>
            <span class="badge">Action Required</span>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Hello Support Team,</p>
            <p>A new support ticket has been submitted by a user and requires your attention. Here are the summary details:</p>

            <!-- Ticket Details Box -->
            <div class="ticket-details">
                <div class="detail-row">
                    <span class="label">Client:</span>
                    <span class="value">{{ $ticket->user->name }} ({{ $ticket->user->email }})</span>
                </div>
                <div class="detail-row">
                    <span class="label">Subject:</span>
                    <span class="value" style="font-weight: 600;">{{ $ticket->title }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Message:</span>
                    <div class="ticket-body">
                        {{ $ticket->body }}
                    </div>
                </div>
            </div>
        <!-- Footer -->
        <div class="footer">
            This is an automated notification from the Support Ticket System.<br>
            &copy; {{ date('Y') }} Support Portal. All rights reserved.
        </div>
    </div>

</body>
</html>
