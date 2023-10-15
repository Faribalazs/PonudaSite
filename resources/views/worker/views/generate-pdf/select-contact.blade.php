<x-app-worker-layout>
    <x-slot name="pageTitle">
        Izaberi kontakt
    </x-slot>
    <x-slot name="header">
        Generiši PDF
    </x-slot>
    <div class="mt-32 font-bold text-3xl">
        <p class="text-center">
            Kakvom licu sajete ponudu ?
        </p>
    </div>
    <div class="mt-24 flex flex-col items-center gap-10">
        <div class="w-1/2">
            <a href="{{ route('worker.archive.fizicka_lica', ['id' => $id]) }}"><button class="confirm-btn">Fizicko lice</button></a>
        </div>
        <div class="w-1/2 justify-center">
            <a href="{{ route('worker.archive.pravna_lica', ['id' => $id]) }}"><button class="confirm-btn">Pravno lice</button></a>
        </div>
    </div>
</x-app-worker-layout>
