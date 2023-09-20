<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <title>{{ $pageTitle }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

</head>

<body class="font-sans antialiased">
    <div class="content-height">
        @include('layouts.navigation')
        {{ $header }}
        <!-- Page Content -->
        <main class="page-padding">
            {{ $slot }}
        </main>
    </div>
    @include('footer')
    @include('sweetalert::alert')
</body>
</html>
