<x-app-worker-layout>
    <x-slot name="pageTitle">
        Ažuriraj poziciju
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <div class="mt-8">
        @php
            $pozicija_title = '';
            $pozicija_desc = '';
            $pozicija_id = '';
        @endphp
        @foreach ($pozicija as $custom_pozicija)
            @php
                $pozicija_title = $custom_pozicija->custom_title;
                $pozicija_desc = $custom_pozicija->custom_description;
                $pozicija_id = $custom_pozicija->id;
            @endphp
        @endforeach
    <form method="POST" id="formPozicija" action="{{ route('worker.options.update.pozicija') }}">
        @csrf
        @method('PUT')
        <input type="text" placeholder="{{ $pozicija_title }}" value="{{ $pozicija_title }}" name="title" class="w-full dropdown-search mt-4">
        <input type="text" placeholder="{{ $pozicija_desc }}" value="{{ $pozicija_desc }}" name="description" class="w-full dropdown-search mt-4">
        <input type="hidden" name="id" value="{{ $pozicija_id }}" class="w-full dropdown-search mt-4">
        <button type="submit" class="add-new-btn my-3">Sačuvaj</button>
    </form>
    </div>
</x-app-layout>
