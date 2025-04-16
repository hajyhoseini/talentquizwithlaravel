<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/font-face.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Webfonts/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body, button, input, select, textarea {
            font-family: 'Vazir', sans-serif !important;
        }

        .custom-page-bg {
            background-image: url('/images/kids-bg.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            position: relative;
            z-index: 0;
            min-height: 100%; /* ارتفاع کامل */
        }

        .custom-page-bg::before {
            content: "";
            position: absolute;
            inset: 0;
            z-index: -1;
        }
    </style>
</head>

<body class="font-sans antialiased custom-page-bg">
    <div class="min-h-screen flex flex-col">
        @include('layouts.navigation')

        <!-- Page Content -->
        <main class="flex-grow">
            {{ $slot }}
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>
</html>
