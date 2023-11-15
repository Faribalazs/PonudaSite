<x-app-worker-layout>
    <x-slot name="pageTitle">
        {{ __('app.generate-pdf.sending-email') }}
    </x-slot>
    <x-slot name="header">
        {{ __('app.generate-pdf.send-ponuda') }}
    </x-slot>
    <div class="mt-24 font-bold text-3xl">
        <p class="text-center">
            {{ __('app.generate-pdf.send-ponuda') }} <b>{{ $name }}.{{ __('app.generate-pdf.pdf') }}</b>
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
        <label class="pl-1">{{ __('app.generate-pdf.to-whom-you-send') }}:</label>
        <input type="email" placeholder="Imejl adresa osobe" name="mailTo"
            class="w-full dropdown-search mt-2">
        <label class="mt-4 pl-1">{{ __('app.generate-pdf.subject-email') }}:</label>
        <input type="text" placeholder="{{ __('app.generate-pdf.subject-email') }}" name="mailSubject"
            class="w-full dropdown-search mt-2">
        <label class="mt-4 pl-1">{{ __('app.generate-pdf.body-email') }}:</label>
        <textarea placeholder="{{ __('app.generate-pdf.body-email') }}" name="mailBody" class="mb-4 w-full dropdown-search mt-2" rows="4"
            cols="50"></textarea>
        <button type="submit" class="add-new-btn w-full my-4">{{ __('app.generate-pdf.send-ponuda') }}</button>
    </form>
</x-app-worker-layout>
