<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>سامانه استعدادیابی</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            <!-- اینجا از یک container استفاده می‌کنیم تا اندازه صفحه برای دستگاه‌های مختلف تغییر کند -->
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 w-full">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
