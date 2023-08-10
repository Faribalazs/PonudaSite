<x-app-worker-layout>
    <x-slot name="pageTitle">
        Uspesno
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <form method="POST" action="{{ route('worker.archive.genarte.tamplate.pdf') }}" class="mt-5 w-full">
        @csrf
        @if (isset($client_id))
            <input type="hidden" name="client_id" value="{{ $client_id }}" />
        @endif
        @if (isset($new))
            <input type="hidden" name="f_name" value="{{ $f_name }}" />
            <input type="hidden" name="l_name" value="{{ $l_name }}" />
            <input type="hidden" name="city" value="{{ $city }}" />
            <input type="hidden" name="zip" value="{{ $zip }}" />
            <input type="hidden" name="adresa" value="{{ $adresa }}" />
            <input type="hidden" name="tel" value="{{ $tel }}" />
            <input type="hidden" name="email" value="{{ $email }}" />
            <input type="hidden" name="new" value="custom" />
        @endif
        @if (isset($save))
            <input type="hidden" name="save" value="save" />
        @endif
        <input type="hidden" name="ponuda_id" value="{{ $ponuda_id }}" />
    </form>
    
    <div class="mt-16 flex">
        <p>Uspesno ste generisali ponudu!</p>
    </div>   
</x-app-worker-layout>