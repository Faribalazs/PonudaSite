<x-app-worker-layout>
    <x-slot name="pageTitle">
        Ugovor
    </x-slot>
    <x-slot name="header">
        Ugovor za fizicka lica
    </x-slot>
    <form method="POST" action="{{ route('worker.archive.download.contract.fizicka_lica') }}">
        @csrf
        <div class="con">
            <div class="mt-20 border border-grey rounded lg:p-14 sm:p-10 p-4 main-div">
                <div class="px-10 flex flex-col">
                    <div class="text-lg text-center mb-14">
                        <b>
                            @if (isset($foundClient))
                                UGOVOR br.
                                <u>&nbsp;{{ auth('worker')->user()->id }}P{{ $id }}K{{ $company_data->id }}{{ $type_lica }}{{ $foundClient->id }}&nbsp;</u>
                                <br>
                            @else
                                UGOVOR
                            @endif
                            O IZVOĐENJU GRAĐEVINSKO - ZANATSKIH RADOVA
                        </b>
                    </div>
                    <div class="text-lg lg:text-justify">
                        <p class="mb-10">
                            Zaključen između
                            <input type="text" style="border-radius: 0px !important;" class="w-60" name="field1"
                                value="{{ $foundClient->first_name }}">
                            <input type="text" style="border-radius: 0px !important;" class="w-60" name="field2"
                                value="{{ $foundClient->last_name }}">iz
                            <input type="text" style="border-radius: 0px !important;" name="field3"
                                value="{{ $foundClient->city }}">,
                            adresa:<input type="text" style="border-radius: 0px !important;" name="field4"
                                value="{{ $foundClient->address }}">,
                            s jedne strane kao naručioca (u daljem tekstu: Naručilac) i
                        </p>
                        <p>
                            <input type="text" style="border-radius: 0px !important;" name="field5"
                                value="{{ $company_data->company_name }}">
                            iz
                            <input type="text" style="border-radius: 0px !important;" name="field6"
                                value="{{ $company_data->city }}">,
                            adresa:<input type="text" style="border-radius: 0px !important;" name="field7"
                                value="{{ $company_data->address }}">,
                            PIB:<input type="text" style="border-radius: 0px !important;" class="w-52"
                                name="field8" value="{{ $company_data->pib }}">s
                            druge strane, koje zastupa direktor <input type="text"
                                style="border-radius: 0px !important;" name="field9">
                            iz<input type="text" style="border-radius: 0px !important;" name="field10">, kao izvođača
                            (u daljem tekstu: Izvođač).
                        </p>
                        <p class="my-10">
                            Ugovorne strane su se sporazumele o sledećem:
                        </p>
                        <p class="text-center mb-10">
                            Član 1.
                        </p>
                        <p class="mb-10">
                            Izvođač se obavezuje da za račun Naručioca izvede građevinsko - zanatske radove na objektu u
                            <input type="text" style="border-radius: 0px !important;" class="w-56" name="field11">
                            ul. <input type="text" style="border-radius: 0px !important;" name="field12">
                            br.<input type="text" style="border-radius: 0px !important;" name="field13"
                                class="w-32">
                            u svemu prema usvojenoj ponudi Izvođača br. <input type="text" class="w-48"
                                style="border-radius: 0px !important;" name="field14">
                            od <input type="date" style="border-radius: 0px !important;" name="field15">
                            koja čini sastavni deo ovog Ugovora.
                        </p>
                        <p class="text-center mb-10">
                            Član 2.
                        </p>
                        <p class="mb-5">
                            Izvođač se obavezuje da:
                        </p>
                        <p class="mb-10">
                            - sve radove iz člana 1. ovog ugovora izvede u skladu sa važećim tehničkim normativima,
                            standardima
                            i
                            propisima;
                            <br>
                            - upotrebljava materijal i opremu koji u svemu odgovaraju važećim normativima i standardima;
                            <br>
                            - će se u toku izvođenja radova pridržavati svih važećih normi iz oblasti bezbednosti i
                            zdravlja
                            na
                            radu.
                        </p>
                        <p class="text-center mb-10">
                            Član 3.
                        </p>
                        <p class="mb-10">
                            Naručilac se obavezuje da na ime cene za sve radove na objektu, iz člana 1. ovog ugovora,
                            plati
                            izvođaču ukupan iznos od
                            <input type="text" style="border-radius: 0px !important;" class="w-40" name="field16"
                                value="{{ $sum }}"> dinara
                            (slovima: <input type="text" style="border-radius: 0px !important;" name="field17"
                                value="{{ $sum_in_words }}">
                            dinara), sa uračunatim PDV-om.
                        </p>
                        <p class="text-center mb-10">
                            Član 4.
                        </p>
                        <p class="mb-10">
                            Ukoliko se ukaže potreba za izvođenjem dodatnih ili nepredviđenih radova, Izvođač će
                            pristupiti
                            njihovom izvođenju
                            nakon ispostavljanja Ponude za ove radove koju će Investitor pisanim putem prihvatiti.
                            U ovom slučaju, ugovorena cena radova iz člana 3 ovog ugovora će se uvećati za iznos
                            dodatnih
                            ili nepredviđenih radova.
                        </p>
                        <p class="text-center mb-10">
                            Član 5.
                        </p>
                        <p class="mb-10">
                            Naručilac se obavezuje da će na ime avansa Izvođaču uplatiti iznos od
                            <input type="text" style="border-radius: 0px !important;" class="w-40" name="field18">
                            dinara, u
                            skladu sa uslovima iz usvojene ponude Izvođača.
                        </p>
                        <p class="text-center mb-10">
                            Član 6.
                        </p>
                        <p class="mb-10">
                            Izvođač se obavezuje da će radove započeti u roku od
                            <input type="text" style="border-radius: 0px !important;" class="w-20" name="field19">
                            dana
                            od dana uplate avansa, u skladu sa
                            uslovima iz usvojene ponude Izvođača.
                        </p>
                        <p class="text-center mb-10">
                            Član 7.
                        </p>
                        <p class="mb-10">
                            Izvođač s obavezuje da sve radove na objektu iz člana 1. ovog ugovora izvede u roku od
                            <input type="text" style="border-radius: 0px !important;" class="w-20"
                                name="field20">
                            radnihdana, u skladu sa uslovima iz usvojene ponude Izvođača.
                        </p>
                        <p class="text-center mb-10">
                            Član 8.
                        </p>
                        <p class="mb-10">
                            Izvođač Naručiocu na izvedene radove daje garanciju u trajanju od dve (dve) godine od dana
                            primopredaje
                            radova.
                        </p>
                        <p class="text-center mb-10">
                            Član 9.
                        </p>
                        <p class="mb-10">
                            Na sve što nije precizirano ovim ugovorom, primenjivaće se odredbe Zakona o obligacionim
                            odnosima.
                        </p>
                        <p class="text-center mb-10">
                            Član 10.
                        </p>
                        <p class="mb-10">
                            Sve eventualne sporove ugovorne strane će rešavati mirnim putem. Ukoliko do rešenja spora
                            nije
                            moguće doći na ovaj način, ugovara se nadležnost suda u
                            <input type="text" style="border-radius: 0px !important;" class="w-52"
                                name="field21">.
                        </p>
                        <p class="text-center mb-10">
                            Član 11.
                        </p>
                        <p class="mb-10">
                            Ovaj ugovor sačinjen je u
                            <input type="text" style="border-radius: 0px !important;" class="w-20"
                                name="field22">
                            istovetna primerka,
                            od kojih se
                            <input type="text" style="border-radius: 0px !important;" class="w-20"
                                name="field23">
                            primerka nalaze kod Naručioca,
                            a <input type="text" style="border-radius: 0px !important;" class="w-20"
                                name="field24">
                            primerka kod Izvođača.
                            U <input type="text" style="border-radius: 0px !important;" class="w-52"
                                name="field25"> ,
                            dana <input type="text" style="border-radius: 0px !important;" class="w-32"
                                name="field26"> godine.
                        </p>
                    </div>
                    <div class="flex justify-between w-100 mt-20">
                        <div class="w-min flex flex-col gap-12 text-center">
                            IZVOĐAČ
                            <div class="w-72 border-b"></div>
                        </div>
                        <div class="w-min flex flex-col gap-12 text-center">
                            NARUČILAC
                            <div class="w-72 border-b"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-center mt-20">
            <button onClick="showBack()" type="submit"
                class="sm:w-1/2 w-full mx-auto text-xl font-bold finish-btn mt-5">
                Skini ugovor
            </button>
        </div>
        <input type="hidden" name="br"
            value="{{ auth('worker')->user()->id }}P{{ $id }}K{{ $company_data->id }}{{ $type_lica }}{{ $foundClient->id }}">
    </form>
    <script>
        function showBack() {
            btn = document.querySelector('.btn');
            btn.style.display = 'flex';
        }
    </script>
    <style>
        input {
            border: none !important;
            border-bottom: 1px solid black !important;
            text-align: center;
            padding-bottom: 3px !important;
            font-size: 18px !important;
        }

        p {
            line-height: 3;
        }

        .main-div {
            min-width: 960px;
        }

        .con {
            width: 100%;
            overflow: scroll;
        }
    </style>
</x-app-worker-layout>
