<x-app-worker-layout>
    <x-slot name="pageTitle">
        Ažuriraj poziciju
    </x-slot>
    <x-slot name="header">
        Ažuriraj poziciju
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
        <div class="flex w-full mt-5">
            <form method="POST" id="formPozicija" action="{{ route('worker.options.update.pozicija') }}"
                class="mt-20 flex flex-col w-full">
                @csrf
                <span class="input-label py-3">Upiši naziv pozicije:</span>
                @method('PUT')
                <input type="text" placeholder="{{ $pozicija_title }}" value="{{ $pozicija_title }}" name="title"
                    class="w-full dropdown-search">
                <span class="input-label py-3 mt-5">Upiši opis pozicije:</span>
                <textarea type="text" rows="5" value="{{ $pozicija_desc }}" name="description"
                    class="w-full dropdown-search">{{ $pozicija_desc }}</textarea>
                <input type="hidden" name="id" value="{{ $pozicija_id }}" class="w-full dropdown-search mt-4">
                <button type="submit" class="main-btn mx-auto mt-10">Sačuvaj</button>
            </form>
        </div>
    </div>
    </x-app-layout>
