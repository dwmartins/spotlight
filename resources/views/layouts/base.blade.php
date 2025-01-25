<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($custom_seo_title) ? $custom_seo_title : $seo['title'] }}</title>

        <meta name="description" content="{{ $seo['description'] }}">
        <meta name="keywords" content="{{ $seo['keywords'] }}">
        <link rel="icon" href="{{ $seo['icon'] }}">

        <!-- font-awesome -->
        <script src="https://kit.fontawesome.com/b019fa643e.js" crossorigin="anonymous"></script>

        @vite('resources/js/translations/' . app()->getLocale() . '.js')
        @stack('scripts')

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <!-- AOS - Animate -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <!-- CSS from Vite -->
        @vite('resources/css/app.css')
        @vite('resources/css/animations.css')
        
        <x-configs.css-variables />

        @stack('styles')
    </head>
    <body>
        <!-- Main Layout -->
        @yield('content')

        <div class="toast-container position-fixed top-0 end-0 p-3" id="toastContainer">
            <!-- Toasts will be added here -->
        </div>

        <!-- Bootstrap JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        
        <!-- AOS - Animate -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
       
        <!-- JS from Vite -->
        @vite('resources/js/helpers.js') 
        @vite('resources/js/app.js')

        <script>
            window.sessionMessage = @json(session('message'));
            window.website_settings = @json(config('website_settings'));
        </script>

        @stack('scripts')
    </body>
</html>
