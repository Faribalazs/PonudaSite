<x-worker-profile-layout>
    <x-slot name="pageTitle">
        Podaci firme
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <div class="flex profile-title">
        <p class="text-3xl font-bold">Podaci firme</p>
    </div>
    <div class="flex mt-3 flex-col">
        {{-- Kell majd egy if ha van hozzaadva akkor kijon a szoveg ha nincs akkor a form --}}
        <form method="POST" action="{{ route('worker.logout') }}" class="flex flex-col">
            @csrf
            <label for="naziv_firme" class="text-xl my-3">Tacan naziv firme :</label>
            <input class="input-style" name="naziv_firme" type="text"/>

            <label for="drzava" class="text-xl my-3">Drzava :</label>
            <input class="input-style" name="drzava" type="text"/>

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

            <label for="pib" class="text-xl my-3">PIB :</label>
            <input class="input-style" name="pib" type="text"/>

            <label for="maticni_broj" class="text-xl my-3">Maticni broj :</label>
            <input class="input-style" name="maticni_broj" type="text"/>

            <label for="tekuci_racun" class="text-xl my-3">Tekuci racun :</label>
            <input class="input-style" name="tekuci_racun" type="text"/>

            <label for="bank_account" class="text-xl my-3">Bank account :</label>
            <input class="input-style" name="bank_account" type="text"/>

            <label for="naziv_banke" class="text-xl my-3">Naziv banke :</label>
            <input class="input-style" name="naziv_banke" type="text"/>

            <label for="logo" class="text-xl my-3">Logo firme :</label>
            <input class="" name="logo" type="file"/>

            <button type="submit" class="finish-btn mt-5 text-xl">Sacuvaj podatke</button>
        </form>
    </div>
        
</x-worker-profile-layout>