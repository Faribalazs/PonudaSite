<x-app-layout>
    <x-slot name="pageTitle">
        Napravi opcije
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <div class="add-new-container">
        <div class="flex-[33%]">
            <a href="{{ route('worker.create.new.category') }}" class="box-a">
                <div class="box">
                    <p class="add-new-title my-3 text-center">Dodaj Kategoriju</p>
                    <p class="text-center pb-3">
                        Dodaj kategoriju koju posle mozes koristiti kad pravis ponudu!
                    </p>
                </div>
            </a>
        </div>
        <div class="flex-[33%]">
            <a href="{{ route('worker.create.new.subcategory') }}" class="box-a">
                <div class="box">
                    <p class="add-new-title my-3 text-center">Dodaj Podkategoriju</p>
                    <p class="text-center pb-3">
                        Dodaj podkategoriju koju posle mozes koristiti kad pravis ponudu!
                    </p>
                </div>
            </a>
        </div>
        <div class="flex-[33%]">
            <a href="{{ route('worker.create.new.pozicija') }}" class="box-a">
                <div class="box">
                    <p class="add-new-title my-3 text-center">Dodaj Poziciju</p>
                    <p class="text-center pb-3">
                        Dodaj poziciju koju posle mozes koristiti kad pravis ponudu!
                    </p>
                </div>
            </a>
        </div>
    </div>
</x-app-layout>
