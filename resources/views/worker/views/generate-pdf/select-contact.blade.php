<x-app-worker-layout>
    <x-slot name="pageTitle">
        Odaberi kontakt
    </x-slot>
    <x-slot name="header">
        Generiši PDF
    </x-slot>
    <div class="mt-32 font-bold text-3xl">
        <p class="text-center">
            Kome šaješ ponudu ?
        </p>
    </div>
    <div class="mt-24 flex flex-col items-center gap-10">
        <div class="w-1/2">
            <a href="{{ route('worker.archive.select.method', ['lice' => 'individual','id' => $id]) }}"><button class="confirm-btn">Fizičkom licu</button></a>
        </div>
        <div class="w-1/2 justify-center">
            <a href="{{ route('worker.archive.select.method', ['lice' => 'legal-entity','id' => $id]) }}"><button class="confirm-btn">Pravnom licu</button></a>
        </div>
    </div>
</x-app-worker-layout>
