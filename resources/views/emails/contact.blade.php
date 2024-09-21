<!DOCTYPE html>
<html>
<head>
    <title>Contact Us Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            font-size: 24px;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
        }
        p {
            color: #555;
            line-height: 1.6;
        }
        .email-details {
            margin-bottom: 20px;
        }
        .email-details p {
            margin: 0;
        }
        .email-footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
        .email-footer a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : '' }}">
        <h1>{{ $data['subject'] }}</h1>
        <div class="email-details">
            <p><strong>{{ __('words.name') }}:</strong> {{ $data['name'] }}</p>
            <p><strong>{{ __('words.email') }}:</strong> {{ $data['email'] }}</p>
        </div>
        <p><strong>{{ __('words.message') }}:</strong></p>
        <p>{{ $data['message'] }}</p>

        <div class="email-footer">
            <p>&copy; {{ date('Y') }} <a href="{{ url('/') }}">{{ config('app.name') }}</a></p>
        </div>
    </div>
</body>
</html>
