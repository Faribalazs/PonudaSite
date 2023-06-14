@php
    $lang = App::currentLocale();
@endphp
<nav x-data="{ open: false }" id="nav">
    <div class="nav sm:hidden">
        <div class="nav__content">
            <div class="nav__list px-4 gap-4">
                <div class="nav__list-item">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('app.nav.dashboard') }}
                    </x-nav-link>
                </div>
                @if (Auth::user())
                    @if (Auth::user()->hasRole('user'))
                        <div class="nav__list-item">
                            <x-nav-link :href="route('myprofile')" :active="request()->routeIs('myprofile')">
                                {{ __('My Profile') }}
                            </x-nav-link>
                        </div>
                    @endif
                @endif
                <div class="nav__list-item">Projects</div>
                <div class="nav__list-item">Contact</div>
            </div>
        </div>
    </div>
    <!-- Primary Navigation Menu -->
    <div class="mx-auto px-4 py-3 sm:px-6 lg:px-8 h-100 align-items-center nav-div">
        <div class="flex justify-between h-100">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center z-50">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('app.nav.dashboard') }}
                    </x-nav-link>
                </div>
                @if (Auth::user())
                    @if (Auth::user()->hasRole('user'))
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex items-center">
                            <x-nav-link :href="route('myprofile')" :active="request()->routeIs('myprofile')">
                                {{ __('My Profile') }}
                            </x-nav-link>
                        </div>
                    @endif
                @endif
                @auth
                    @if (Auth::guard('admin')->user()->hasRole('admin'))
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex items-center">
                            <x-nav-link :href="route('admin.profile')" :active="request()->routeIs('admin.profile')">
                                {{ __('Admin Profile') }}
                            </x-nav-link>
                        </div>
                    @endif
                @endauth
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6 space-x-5">
                <button onclick="LanguageSwitcher('{{ $lang }}')">
                    <i class="ri-earth-line sm:text-3xl text-2xl"></i>
                </button>
                @if (!Auth::user())
                    <a href="{{ route('login') }}">
                        <i class="ri-user-3-line sm:text-3xl text-2xl"></i>
                    </a>
                @endif
                @if (Auth::user())
                    @php
                        $logInCircle = mb_substr(Auth::user()->name, 0, 1);
                    @endphp
                    <div class="flex gap-1">
                        <div class="flex justify-center items-center">
                            <a href="{{ route('myprofile') }}">{{ Auth::user()->name }}</a>
                        </div>
                        <div class="profile-circle">
                            {{$logInCircle}}
                        </div>
                    </div>
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden gap-4" style="margin-top:8px;">
                <button onclick="LanguageSwitcher('{{ $lang }}')" class="lang-btn-nav">
                    <i class="ri-earth-line sm:text-3xl text-2xl"></i>
                </button>
                @if (!Auth::user())
                    <a href="{{ route('login') }}" class="log-in-btn-nav">
                        <i class="ri-user-3-line sm:text-3xl text-2xl"></i>
                    </a>
                @endif
                <div class="menu-icon">
                    <span class="menu-icon__line menu-icon__line-left"></span>
                    <span class="menu-icon__line"></span>
                    <span class="menu-icon__line menu-icon__line-right"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        @if (Auth::user())
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div class="flex-shrink-0">
                        <svg class="h-10 w-10 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>

                    <div class="ml-3">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Logout') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endif
    </div>
</nav>
<script>
    const app = (() => {
        let body;
        let menu;
        let menuItems;

        const init = () => {
            body = document.querySelector('body');
            menu = document.querySelector('.menu-icon');
            menuItems = document.querySelectorAll('.nav__list-item');
            applyListeners();
        }
        const applyListeners = () => {
            menu.addEventListener('click', () => toggleClass(body, 'nav-active'));
            menu.addEventListener('click', () => toggleClass(body, 'pf'));
        }
        const toggleClass = (element, stringClass) => {
            if (element.classList.contains(stringClass))
                element.classList.remove(stringClass);
            else
                element.classList.add(stringClass);
        }
        init();
    })();

    window.onscroll = function() {myFunction()};
        var navbar = document.getElementById("nav");

        var sticky = navbar.offsetTop-20;

        function myFunction() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
        }

    function LanguageSwitcher(lang) {
        Swal.fire({
            html: "@if ($lang == 'hu')<a href='{{ url(getCurrentUrlWithLocale('hu')) }}' class='disabled-link'>Hungarian</a><br>" +
                "@else <a href='{{ url(getCurrentUrlWithLocale('hu')) }}' class='language-name'>Hungarian</a><br> @endif" +
                "@if ($lang == 'en')<a href='{{ url(getCurrentUrlWithLocale('en')) }}' class='disabled-link'>English</a><br>" +
                "@else <a href='{{ url(getCurrentUrlWithLocale('en')) }}' class='language-name' >English</a><br> @endif" +
                "@if ($lang == 'rs')<a href='{{ url(getCurrentUrlWithLocale('rs')) }}' class='disabled-link'>Serbian</a><br>" +
                "@else <a href='{{ url(getCurrentUrlWithLocale('rs')) }}' class='language-name'>Serbian</a><br> @endif",
            showCloseButton: true,
            showCancelButton: false,
            showConfirmButton: false,
        })
    }
</script>
<style>
    .profile-circle {
        width: 30px;
        height: 30px;
        border-radius:50%;
        font-weight: 700;
        font-size: 15px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        background-color: #333f9d;
    }
    .sticky {
        position: sticky !important;
    }
</style>
