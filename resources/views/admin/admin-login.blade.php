<x-app-layout>
    <x-slot name="pageTitle">
Admin log in
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <div class="win-height">
        <div class="log-in-container">
            <div class="log-in-form py-8">
                <div class="log-in-welcome">
                    <span class="welcome-text">{{ __('app.auth.welcome') }}</span>
                    <img src="{{ asset('img/logo.svg') }}" class="welcome-img my-7">
                </div>
                <form method="POST" action="{{ route('admin.session.create') }}">
                    @csrf
                    <!-- Email Address -->
                    <div>
                        <x-label for="email" :value="__('app.auth.e-mail')" class="pl-3" />
                        <x-input id="email" class="block mt-1 w-full rounded-3xl" type="email" name="email"
                            :value="old('email')" required />
                    </div>
                    <!-- Password -->
                    <div class="sm:mt-4 mt-2">
                        <x-label for="password" :value="__('app.auth.password')" class="pl-3 text-md" />
                        <x-input id="password" class="block mt-1 w-full rounded-3xl" type="password" name="password"
                            required autocomplete="current-password" />
                    </div>
                    <div class="d-flex align-items-baseline justify-content-between mt-4 form-buttons">
                        <button class="mt-3 confirm-btn">
                            {{ __('app.auth.log-in') }}
                        </button>
                    </div>
                </form>
            </div>
            <div class="log-in-img">

            </div>
        </div>
    </div>
    @if (session('status') == 'Your password has been reset!')
        <script>
            Swal.fire({
                title: "{{ __('app.email.reset-password-success') }}",
                icon: 'success',
                html: "<span>{{ __('app.email.reset-password-success-text') }}</span>",
                showCloseButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            })
        </script>
    @endif
    <style>
        body {
            background: linear-gradient(-45deg, #164E99, #72afff);
            animation: gradient 5s ease infinite;
            background-size: 400% 400%;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%
            }

            50% {
                background-position: 100% 50%
            }

            100% {
                background-position: 0% 50%
            }
        }

        .page-padding {
            padding-top: 0px !important;
        }
    </style>
</x-app-layout>
