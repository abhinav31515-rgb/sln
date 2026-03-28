<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <h1 style="color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 10px;">
        Booking Confirmation
    </h1>
    
    <p>Dear {{ $booking->user->name }},</p>
    
    <p>Your booking at <strong>{{ $identity->get('brand_name') }}</strong> has been confirmed!</p>
    
    <div style="background-color: #f8f9fa; border-left: 4px solid #3498db; padding: 15px; margin: 20px 0;">
        <h2 style="margin-top: 0; color: #2c3e50; font-size: 18px;">Booking Details</h2>
        
        <p style="margin: 8px 0;">
            <strong>Date:</strong> {{ $booking->appointment_date->format('l, F j, Y') }}
        </p>
        
        <p style="margin: 8px 0;">
            <strong>Time:</strong> {{ $booking->start_time }}
        </p>
        
        <p style="margin: 8px 0;">
            <strong>Service:</strong> {{ $booking->service->name }}
        </p>
        
        <p style="margin: 8px 0;">
            <strong>Therapist:</strong> {{ $booking->therapist->user->name }}
        </p>
    </div>
    
    <p>We look forward to seeing you!</p>
    
    <p style="margin-top: 30px; color: #7f8c8d; font-size: 14px;">
        If you have any questions, please don't hesitate to contact us.
    </p>
    
    <p style="margin-top: 20px;">
        Best regards,<br>
        <strong>{{ $identity->get('brand_name') }}</strong>
    </p>
</body>
</html>
