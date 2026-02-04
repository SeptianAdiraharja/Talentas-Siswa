<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $tittle ?? config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

        <link rel="icon" type="image/jpeg" href="{{ asset('images/logo2.jpeg') }}">

        <style>
            /* Pastikan gambar menutupi area secara proporsional */
            .object-fit-cover { object-fit: cover; }
            /* Hapus padding/margin default dari Breeze */
            body { margin: 0; padding: 0; }
        </style>
    </head>
    <body class="bg-gradient-light">
        {{ $slot }}

        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    </body>
</html>