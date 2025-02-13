<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ trans('messages.email_subject') }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 700px;
            margin: 0 auto;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.137);
        }
        .email-header {
            margin-top: 20px;
            text-align: center;
        }
        .email-header img {
            max-width: 200px;
            max-height: 100px;
        }
        .email-body {
            padding: 20px;
            text-align: center;
        }
        .email-body h2 {
            font-size: 20px;
            margin-bottom: 20px;
        }
        .email-body p {
            font-size: 16px;
            line-height: 1.5;
        }
        .reset-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            color: #ffff !important;
        }
        .email-footer {
            padding: 10px;
            text-align: center;
            font-size: 12px;
            color: #666666;
        }
        .email-footer a {
            color: #2575fc;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <img src="{{ $websiteLogo }}" alt="{{ config('website_info.websiteName') }}">
        </div>

        <div class="email-body">
            <h2>{{ trans('messages.hello') }}, {{ $user->name }}!</h2>
            <p>{{ trans('messages.email_receiving_reset_password') }}</p>
            <p>{{ trans('messages.email_click_the_button_reset_password') }}</p>
            <a href="{{ $resetUrl }}" class="reset-button" style="background: {{ config('website_colors.primary') }}">{{ trans('messages.btn_text_reset_password_by_email') }}</a>
            <p>{{ trans('messages.email_not_request_password_reset') }}</p>
        </div>

        <div class="email-footer">
            <p>
                {{ trans('messages.email_have_trouble_clicking_the_button') }}
                <br>
                <a href="{{ $resetUrl }}">{{ $resetUrl }}</a>
            </p>
            <p>
                &copy; {{ date('Y') }} {{ config('website_info.websiteName') }}. {{ trans('messages.all_rights_reserved') }}
            </p>
        </div>
    </div>
</body>
</html>