<x-app-worker-layout>
    <x-slot name="pageTitle">
        Slanje u emailu
    </x-slot>
    <x-slot name="header">
        Pošalji ponudu
    </x-slot>
    <div class="mt-24 font-bold text-3xl">
        <p class="text-center">
            Pošalji ponudu <b>{{ $name }}.pdf</b>
        </p>
    </div>
    <form method="POST" id="sendPDF"
        action="{{ route('worker.archive.send.mail') }}">
        @csrf
        @if (isset($id))
            <input type="hidden" name="id" value="{{ $id }}" />
        @endif
        @if (isset($client_id))
            <input type="hidden" name="client_id" value="{{ $client_id }}" />
        @endif
        @if (isset($type))
            <input type="hidden" name="type" value="{{ $type }}" />
        @endif
        @if (isset($temporary))
            <input type="hidden" name="temporary" value="{{ $temporary }}" />
        @endif
        @if (isset($pdf_blade))
            <input type="hidden" name="pdf" value="{{ $pdf_blade }}" />
        @endif
        <label class="pl-1">Kome šalješ:</label>
        <input type="email" placeholder="Imejl adresa osobe" name="mailTo"
            class="w-full dropdown-search mt-2">
        <label class="mt-4 pl-1">Predmet E-maila:</label>
        <input type="text" placeholder="Predmet e-pošte" name="mailSubject"
            class="w-full dropdown-search mt-2">
        <label class="mt-4 pl-1">Telo E-maila:</label>
        <textarea placeholder="Telo e-pošte" name="mailBody" class="mb-4 w-full dropdown-search mt-2" rows="4"
            cols="50"></textarea>
        <button type="submit" class="add-new-btn w-full my-4">Pošalji</button>
    </form>
</x-app-worker-layout>
