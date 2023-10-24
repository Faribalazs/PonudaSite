<x-app-worker-layout>
    <x-slot name="pageTitle">
        Izaberi kontakt
    </x-slot>
    <x-slot name="header">
        Generiši PDF
    </x-slot>
    <div class="mt-32 font-bold text-3xl">
        <p class="text-center">
            Hoćete dodati novi kontakt ili ćete izabrati iz kontakta ?
        </p>
    </div>
    <div class="mt-24 flex flex-col items-center gap-10">
        <div class="w-1/2">
            @if ((isset($fizicka_lica) && count($fizicka_lica)) || (isset($pravna_lica) && count($pravna_lica)))
                <a href="{{ route('worker.archive.show.lica', ['lice' => $lice, 'method' => 'contact', 'id' => $id]) }}">
                    <button class="confirm-btn">Izaberi iz kontakta</button>
                </a>
            @else
                <button class="disabled-btn" disabled >Izaberi iz kontakta</button>
                <p class="text-red mt-2 text-center">Nemate dodato kontakta</p>
            @endif
        </div>
        <div class="w-1/2 justify-center">
            <a href="{{ route('worker.archive.show.lica', ['lice' => $lice, 'method' => 'add_new', 'id' => $id]) }}">
                <button class="confirm-btn">Dodaj novi kontakt</button>
            </a>
        </div>
    </div>
</x-app-worker-layout>
