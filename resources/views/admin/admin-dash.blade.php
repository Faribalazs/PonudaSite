<x-app-layout>
    <x-slot name="pageTitle">
        {{ __('app.auth.log-in') }}
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <div>
        admin log log in
    </div>
</x-app-layout>
