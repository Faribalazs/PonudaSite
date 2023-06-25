<x-app-layout>
    <x-slot name="pageTitle">
        Slanje u emailu
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <div class="win-height">
        <div class="log-in-container">
            <div class="log-in-form py-8">
                <p class="w-full text-center py-10 title">
                    Pošajite ponudu <b>{{ $name[0]->ponuda_name }}.pdf</b>
                </p>
                <form method="POST" id="sendPDF"
                    action="{{ route('worker.archive.send.mail', ['id' => $id_archive]) }}">
                    @csrf
                    <label class="pl-1">Kome sejete :</label>
                    <input type="email" placeholder="Imejl adresa osobe" name="mailTo"
                        class="w-full dropdown-search mt-2">
                    <label class="mt-4 pl-1">Predmet E-maila :</label>
                    <input type="text" placeholder="Predmet e-pošte" name="mailSubject"
                        class="w-full dropdown-search mt-2">
                    <label class="mt-4 pl-1">Telo E-maila :</label>
                    <textarea placeholder="Telo e-pošte" name="mailBody" class="mb-4 w-full dropdown-search mt-2" rows="4"
                        cols="50"></textarea>
                    <button type="submit" class="add-new-btn w-full my-4">Pošalji</button>
                </form>
            </div>
        </div>
    </div>
    <style>
        .page-padding {
            padding-top: 0px !important;
        }

        .log-in-form {
            width: 75%
        }

        .win-height {
            height: 100vh !important;
        }

        .title {
            font-size: 25px;
        }

        label {
            font-size: 18px;
        }

        .add-new-btn {
            font-size: 18px;
        }

        @media (max-width: 640px) {

            .title {
                font-size: 18px;
            }

            label,
            input {
                font-size: 16px !important;
            }

            .add-new-btn {
                font-size: 16px;
            }

            .log-in-container {
                margin-top: auto !important;
            }
        }
    </style>
</x-app-layout>
