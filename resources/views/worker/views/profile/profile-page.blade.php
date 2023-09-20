<x-worker-profile-layout>
    <x-slot name="pageTitle">
        Profil
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <div class="flex profile-title">
        <p class="text-3xl font-bold">Moj nalog</p>
    </div>
    <div class="flex mt-3 flex-col">
        <div class="mt-3">
            <p class="text-xl"><b>Ime i prezime :</b> {{ Auth::user()->name }}</p>
        </div>
        <div class="mt-3">
            <p class="text-xl"><b>E-mail :</b> {{ Auth::user()->email }}</p>
        </div>
    </div>
</x-worker-profile-layout>
