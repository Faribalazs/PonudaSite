<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title>{{ $pageTitle }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen">
        @include('worker.layouts.navigation')

        <!-- Page Content -->
        <main class="page-padding-profile">
            <div class="flex justify-end mt-16 log-out-con mr-5">
                <form method="POST" action="{{ route('worker.logout') }}" class="log-out-btn flex items-center">
                    @csrf
            
                    <a href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        Odjavi se
                    </a>
                    <i class="ri-logout-box-r-line text-xl ml-2"></i>
                </form>
            </div>

            <div class="menu-section-mobile mt-10 px-4">
                <div class="w-full">
                    <div class="flex sm:flex-row flex-col sm:gap-0 gap-2 justify-between w-full ">
                        <div class="menu-item-mobile flex flex-col justify-between px-3 py-2 {{ request()->routeIs('worker.myprofile') ? 'profile-menu-active-mobile' : '' }}">
                            <a href="{{ route('worker.myprofile') }}" class="flex flex-row justify-between">
                                <div>
                                    <p>Moj nalog</p>
                                </div>
                                <div>
                                    <i class="ri-arrow-down-s-line"></i>
                                </div>
                            </a>
                        </div>

                        <div class="flex mobile-spacer"></div>

                        <div class="menu-item-mobile flex flex-col justify-between px-3 py-2 {{ request()->routeIs('worker.personal.data') ? 'profile-menu-active-mobile' : '' }}">
                            <a href="{{ route('worker.personal.data') }}" class="flex flex-row justify-between">
                                <div>
                                    <p>Podaci firme</p>
                                </div>
                                <div>
                                    <i class="ri-arrow-down-s-line"></i>
                                </div>
                            </a>
                        </div>

                        <div class="flex mobile-spacer"></div>

                        <div class="menu-item-mobile flex flex-col justify-between px-3 py-2 {{ request()->routeIs('worker.personal.contacts') ? 'profile-menu-active' : '' }} {{ request()->routeIs('worker.personal.contacts.add.legal-entity') ? 'profile-menu-active' : '' }} {{ request()->routeIs('worker.personal.contacts.add.individual') ? 'profile-menu-active' : '' }}">
                            <a href="{{ route('worker.personal.contacts') }}" class="flex flex-row justify-between">
                                <div>
                                    <p>Moji klijenti</p>
                                </div>
                                <div>
                                    <i class="ri-arrow-down-s-line"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 flex flex-row gap-4 profile-con">
                <div class="menu-section w-1/4">
                    <div class="flex flex-col gap-3">
                        <div class="menu-item flex flex-col justify-between px-3 py-2 {{ request()->routeIs('worker.myprofile') ? 'profile-menu-active' : '' }}">
                            <a href="{{ route('worker.myprofile') }}" class="flex flex-row justify-between">
                                <div>
                                    <p>Moj nalog</p>
                                </div>
                                <div>
                                    <i class="ri-arrow-right-s-line"></i>
                                </div>
                            </a>
                        </div>

                        <div class="menu-item flex flex-col justify-between px-3 py-2 {{ request()->routeIs('worker.personal.data') ? 'profile-menu-active' : '' }}">
                            <a href="{{ route('worker.personal.data') }}" class="flex flex-row justify-between">
                                <div>
                                    <p>Podaci firme</p>
                                </div>
                                <div>
                                    <i class="ri-arrow-right-s-line"></i>
                                </div>
                            </a>
                        </div>

                        <div class="menu-item flex flex-col justify-between px-3 py-2 {{ request()->routeIs('worker.personal.contacts') ? 'profile-menu-active' : '' }} {{ request()->routeIs('worker.personal.contacts.add.legal-entity') ? 'profile-menu-active' : '' }} {{ request()->routeIs('worker.personal.contacts.add.individual') ? 'profile-menu-active' : '' }}">
                            <a href="{{ route('worker.personal.contacts') }}" class="flex flex-row justify-between">
                                <div>
                                    <p>Moji klijenti</p>
                                </div>
                                <div>
                                    <i class="ri-arrow-right-s-line"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="content-section w-3/4">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>
    @include('footer')
    @include('sweetalert::alert')
</body>

</html>
