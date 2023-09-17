<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>{{ $pageTitle }}</title>

    <!-- Styles -->
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen">
        @include('worker.layouts.navigation')

        <!-- Page Content -->
        <main class="page-padding-profile">
            <div class="flex overflow-hidden flex-nowrap">
                <div class="profile-side-panel w-14">
                    <div class="menu-btn">
                        <div class="line line--1"></div>
                        <div class="line line--2"></div>
                        <div class="line line--3"></div>
                    </div>
                    <div class="closed-links">
                        <a href="{{ route('worker.myprofile') }}"
                            class="icons {{ request()->routeIs('worker.myprofile') ? 'closed-icon-active' : '' }}">
                            <i class="ri-user-3-line"></i>
                        </a>
                        <a href="{{ route('worker.personal.data') }}"
                            class="icons {{ request()->routeIs('worker.personal.data') ? 'closed-icon-active' : '' }}">
                            <i class="ri-pass-valid-line"></i>
                        </a>
                        <a href="{{ route('worker.personal.contacts') }}"
                            class="icons 
                            {{ request()->routeIs('worker.personal.contacts') ? 'closed-icon-active' : '' }}
                            {{ request()->routeIs('worker.personal.contacts.add.legal-entity') ? 'closed-icon-active' : '' }}
                            {{ request()->routeIs('worker.personal.contacts.add.individual') ? 'closed-icon-active' : '' }}
                            {{ request()->routeIs('worker.personal.contacts.edit.fizicka') ? 'closed-icon-active' : '' }}
                            {{ request()->routeIs('worker.personal.contacts.edit.pravna') ? 'closed-icon-active' : '' }}">
                            <i class="ri-contacts-line"></i>
                        </a>
                        <form method="POST" id="log-out-form" action="{{ route('worker.logout') }}" class="icons">
                            @csrf
                            <button type="button" onclick="logOut()"><i class="ri-logout-box-r-line"></i></button>
                        </form>
                    </div>
                    <div class="nav-links">
                        <a href="{{ route('worker.myprofile') }}" class="link">
                            Moj nalog
                        </a>
                        <a href="{{ route('worker.personal.data') }}" class="link">
                            podaci firme
                        </a>
                        <a href="{{ route('worker.personal.contacts') }}" class="link">
                            moji klijenti
                        </a>
                        <a onclick="logOut()" class="link cursor-pointer">
                            odjavi se
                        </a>
                    </div>
                </div>
                <div style="width: calc(100% - 124px); min-width: calc(100% - 124px);">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>
    @include('footer')
    @include('sweetalert::alert')
</body>
<script>
    var menuBtn = document.querySelector('.menu-btn');
    var navPanel = document.querySelector('.profile-side-panel');
    var lineOne = document.querySelector('.profile-side-panel .menu-btn .line--1');
    var lineTwo = document.querySelector('.profile-side-panel .menu-btn .line--2');
    var lineThree = document.querySelector('.profile-side-panel .menu-btn .line--3');
    var link = document.querySelector('.profile-side-panel .nav-links');
    menuBtn.addEventListener('click', () => {
        navPanel.classList.toggle('nav-open');
        lineOne.classList.toggle('line-cross');
        lineTwo.classList.toggle('line-fade-out');
        lineThree.classList.toggle('line-cross');
        link.classList.toggle('fade-in');
    })

    function logOut() {
        Swal.fire({
            title: 'Stvarno hecete da se odjavite ?',
            showCancelButton: true,
            icon: 'question',
            confirmButtonText: 'Da',
            showCloseButton: true,
            confirmButtonColor: '#ac1902',
            cancelButtonText: 'Ne',
        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector('#log-out-form').submit();
            }
        })
    }
</script>
<style>
    .footer-bg {
        margin-top: 0px !important;
    }
</style>

</html>
