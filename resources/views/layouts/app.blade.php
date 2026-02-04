<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $tittle ??  config('app.name', 'Laravel') }}</title>

        <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <link rel="icon" type="image/jpeg" href="{{ asset('images/logo2.jpeg') }}">
    </head>

    <body id="page-top">

        <div id="wrapper">

            @include('layouts.sidebar')

            <div id="content-wrapper" class="d-flex flex-column">

                <div id="content">

                    @include('layouts.navigation')

                    <div class="container-fluid">
                        {{ $slot }}
                    </div>
                    </div>
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; {{ config('app.name') }} 2026</span>
                        </div>
                    </div>
                </footer>
                </div>
            </div>
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    </body>
</html>