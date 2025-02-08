<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ trans('messages.EMAIL_SUBJECT') }}</title>
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
            <h2>{{ trans('messages.HELLO') }}, {{ $user->name }}!</h2>
            <p>{{ trans('messages.EMAIL_RECEIVING_RESET_PASSWORD') }}</p>
            <p>{{ trans('messages.EMAIL_CLICK_THE_BUTTON_RESET_PASSWORD') }}</p>
            <a href="{{ $resetUrl }}" class="reset-button" style="background: {{ config('website_colors.primary') }}">{{ trans('messages.BTN_TEXT_RESET_PASSWORD_BY_EMAIL') }}</a>
            <p>{{ trans('messages.EMAIL_NOT_REQUEST_PASSWORD_RESET') }}</p>
        </div>

        <div class="email-footer">
            <p>
                {{ trans('messages.EMAIL_HAVE_TROUBLE_CLICKING_THE_BUTTON') }}
                <br>
                <a href="{{ $resetUrl }}">{{ $resetUrl }}</a>
            </p>
            <p>
                &copy; {{ date('Y') }} {{ config('website_info.websiteName') }}. {{ trans('messages.ALL_RIGHTS_RESERVED') }}
            </p>
        </div>
    </div>
</body>
</html>