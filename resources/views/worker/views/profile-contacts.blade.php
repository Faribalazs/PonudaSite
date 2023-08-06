<x-worker-profile-layout>
    <x-slot name="pageTitle">
        Moji klijenti
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <div class="flex profile-title">
        <p class="text-3xl font-bold">Moji klijenti</p>
    </div>
    <div class="flex mt-3 flex-col">
        {{-- Kell majd egy if ha van hozzaadva akkor kijon a szoveg edit gombal es
             torlessel hasonloan mind az archivumban ha nincs akkor a form --}}
        @if (!empty($clients))
            @foreach ($clients as $client)
                <p>{{ $client->first_name }} {{ $client->last_name }} <a href="{{ route('worker.personal.contacts.update', ['id' => $client->id]) }}">UPDATE</a> <a href="{{ route('worker.personal.contacts.delete', ['id' => $client->id]) }}">DELETE</a></p>
            @endforeach
        @endif
        <form method="POST" action="{{ route('worker.personal.contacts.save') }}" class="flex flex-col">
            @csrf
            @if (session()->has('updateClient'))
            @php
                $updateClient = session('updateClient');
            @endphp
            <input class="input-style" name="id" hidden value="{{ $updateClient->id }}" type="text"/>
            <label for="f_name" class="text-xl my-3">Ime :</label>
            <input class="input-style" name="f_name" value="{{ $updateClient->first_name }}" type="text"/>

            <label for="l_name" class="text-xl my-3">Prezime :</label>
            <input class="input-style" name="l_name" value="{{ $updateClient->last_name }}" type="text"/>

            <label for="grad" class="text-xl my-3">Grad :</label>
            <input class="input-style" name="grad" value="{{ $updateClient->city }}" type="text"/>

            <label for="postcode" class="text-xl my-3">Postanski broj :</label>
            <input class="input-style" name="postcode" value="{{ $updateClient->zip_code }}" type="text"/>

            <label for="adresa" class="text-xl my-3">Adresa :</label>
            <input class="input-style" name="adresa" value="{{ $updateClient->address }}" type="text"/>

            <label for="email" class="text-xl my-3">E-mail :</label>
            <input class="input-style" name="email" value="{{ $updateClient->email }}" type="text"/>

            <label for="tel" class="text-xl my-3">Telefon :</label>
            <input class="input-style" name="tel" value="{{ $updateClient->tel }}" type="text"/>
            @else
            <label for="f_name" class="text-xl my-3">Ime :</label>
            <input class="input-style" name="f_name" type="text"/>

            <label for="l_name" class="text-xl my-3">Prezime :</label>
            <input class="input-style" name="l_name" type="text"/>

            <label for="gard" class="text-xl my-3">Grad :</label>
            <input class="input-style" name="grad" type="text"/>

            <label for="postcode" class="text-xl my-3">Postanski broj :</label>
            <input class="input-style" name="postcode" type="text"/>

            <label for="adresa" class="text-xl my-3">Adresa :</label>
            <input class="input-style" name="adresa" type="text"/>

            <label for="email" class="text-xl my-3">E-mail :</label>
            <input class="input-style" name="email" type="text"/>

            <label for="tel" class="text-xl my-3">Telefon :</label>
            <input class="input-style" name="tel" type="text"/>
            @endif
            <button type="submit" class="finish-btn mt-5 text-xl">Dodaj klijenta</button>
        </form>
    </div>
        
</x-worker-profile-layout>