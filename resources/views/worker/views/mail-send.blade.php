<x-app-layout>
    <x-slot name="pageTitle">
        Pošalji PDF
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <div class="mt-8">
        <form method="POST" id="sendPDF" action="{{ route('worker.archive.send.mail', ['id' => $id_archive]) }}">
            @csrf
            <input type="text" placeholder="Imejl adresu osobe" name="mailTo" class="w-full dropdown-search mt-4">
            <input type="text" placeholder="Predmet e-pošte" name="mailSubject" class="w-full dropdown-search mt-4">
            <input type="text" placeholder="Telo e-pošte" name="mailBody" class="w-full dropdown-search mt-4">
            <button type="submit" class="add-new-btn my-3">Pošalji</button>
        </form>
    </div>
</x-app-layout>