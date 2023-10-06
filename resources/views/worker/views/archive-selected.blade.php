<x-app-worker-layout>
    <x-slot name="pageTitle">
        Moja Arhiva
    </x-slot>
    <x-slot name="header">
    </x-slot>
    @php
        $finalPrice = 0;
        $titleBold = 0;
        $uniqueName = [];
        \Carbon\Carbon::setLocale(app()->getLocale())
    @endphp
    @if ($mergedData != null)
    @php
        $finalData = $mergedData->sortBy('id')->groupBy('categories_id');
    @endphp
        <div class="flex mt-16">
            <div class="flex justify-center flex-col lg:flex-row w-full items-center gap-4">
                <a href="{{ route('worker.archive.select.contact', ['id' => $ponuda_name->id_ponuda]) }}" Skini
                    class="archive-pdf-btn">
                    <i class="ri-download-2-line"></i>Generiši PDF</a>
                <a target="_blank"
                    href="{{ route('worker.archive.view.pdf', ['id' => $ponuda_name->id_ponuda]) }}" Skini
                    class="archive-pdf-btn">
                    <i class="ri-eye-line"></i>Pogledaj PDF</a>
                <a href="{{ route('worker.archive.edit', ['ponuda_id' => $ponuda_name->id_ponuda]) }}" Skini
                    class="archive-pdf-btn">
                    <i class="ri-edit-line"></i>Izmeni ponudu</a>
            </div>
        </div>
        <br>
        <p>
            Kreirano : <b>{{ $ponuda_name->created_at->translatedFormat('l jS F Y H:i') }}</b>
        </p>
        @if (isset($ponuda_name->updated_at))
            <p>
                Ažuriran : {{ $ponuda_name->updated_at->translatedFormat('l jS F Y H:i') }}
            </p>
        @endif
        <div class="overflow-auto">
            @foreach ($finalData as $data)
                <table class="ponuda-table w-full mt-5">
                    <thead>
                        <tr>
                            <th scope="col" class="p-2 text-center">r.br.</th>
                            <th scope="col" class="p-2 text-center">Naziv</th>
                            <th scope="col" class="p-2 text-center">j.m.</th>
                            <th scope="col" class="p-2 text-center">količina</th>
                            <th scope="col" class="p-2 text-center">jed.cena</th>
                            <th scope="col" class="p-2 text-center">ukupno</th>
                            <th scope="col" class="p-2 text-center">izbriši</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $subPrice = 0;
                            $i = 1;
                        @endphp
                        @foreach ($data as $item)
                            @php
                                $name_category = $item->name_category != null ? $item->name_category : ($item->name_custom_category != null ? $item->name_custom_category : ''); 
                                $title = $item->temporary_title != null ? $item->temporary_title : ($item->title != null ? $item->title : ($item->custom_title != null ? $item->custom_title : ''));
                                $desc_now = $item->temporary_description != null ? $item->temporary_description : ($item->description != null ? $item->description : ($item->custom_description != null ? $item->custom_description : ''));
                            @endphp
                            @if ($name_category != null && !in_array($name_category, $uniqueName))
                                <tr>
                                    <td colspan="8" class="text-left p-1 border-bold padding-5"
                                        style="background-color: rgba(0, 0, 0, 0.05);">
                                        <b>{{ $name_category }}</b>
                                        @php
                                            $uniqueName[] = $name_category;
                                        @endphp
                                    </td>
                                </tr>
                            @endif
                            @php
                                $subPrice += $item->overall_price;
                            @endphp
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td class="text-left ponuda-table-des p-2"><b>
                                    {{ $title }}
                                    </b><br>
                                    {{ $desc_now }}
                                    <br>{{ $item->name_service }}
                                </td>
                                <td class="text-center">{{ $item->unit_name }}</td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-center">{{ $item->unit_price }}&nbsp;RSD</td>
                                <td class="whitespace-nowrap px-1 border-left text-center">
                                    {{ number_format($item->overall_price, 0, ',', ' ') }}&nbsp;RSD
                                </td>
                                <td><button class="delete-btn-table mx-auto"
                                        onclick="actionSwall('{{ route('worker.archive.delete.element') }}','{{ $title }}', {{ $item->id }}, {{ $item->ponuda_id }})">
                                        <i class="ri-delete-bin-line"></i>
                                    </button></td>

                            </tr>
                            @php 
                                $finalPrice += $subPrice;
                            @endphp
                            @if ($loop->last)
                                <tr>
                                    <td colspan="8" class="text-right border-bold whitespace-nowrap p-1">
                                        <b>Svega&nbsp;{{ $name_category }}:</b>&nbsp;{{ number_format($subPrice, 0, ',', ' ') }}&nbsp;RSD
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @endforeach
            <div style="border-right: 1px solid black;">
                <table class="ponuda-table mt-5">
                    <tbody>
                        <tr>
                            <td colspan="8" class="text-left border-bold p-1"
                                style="background-color: rgba(0, 0, 0, 0.05);"><b>Rekapitulacija</b></td>
                        </tr>
                        @foreach ($finalData as $data)
                            @php
                                $subPrice = 0;
                            @endphp
                            @foreach ($data as $rekapitulacija)
                                @php
                                    $name_category_rekapitulacija = $rekapitulacija->name_category != null ? $rekapitulacija->name_category : ($rekapitulacija->name_custom_category != null ? $rekapitulacija->name_custom_category : null); 
                                    $subPrice += $rekapitulacija->overall_price;
                                @endphp
                                @if ($loop->last)
                                    <tr>
                                        <td class="text-left w-full p-1">
                                            {{ $name_category_rekapitulacija }}&nbsp;
                                        </td>
                                        <td class="px-1 text-center whitespace-nowrap">
                                            {{ number_format($subPrice, 0, ',', ' ') }}&nbsp;RSD
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <table class="table mt-20 text-end ponuda-table w-full">
                    <tr>
                        <td class="text-right whitespace-nowrap p-1">
                            <b>UKUPNO: {{ number_format($finalPrice, 0, ',', ' ') }}&nbsp;RSD</b>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right whitespace-nowrap p-1">
                            @php
                                $pdv = intval($finalPrice) * 0.2;
                            @endphp
                            PDV: {{ number_format($pdv, 0, ',', ' ') }}&nbsp;RSD
                        </td>
                    </tr>
                </table>
                <table class="ponuda-table w-full text-center">
                    <tr>
                        <td class="text-center whitespace-nowrap border-bold p-1">
                            @php
                                $final = $pdv + $finalPrice;
                            @endphp
                            <b>Ukupno sa PDV: {{ number_format($final, 0, ',', ' ') }}&nbsp;RSD</b>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        @if (isset($ponuda_name->opis))
            <div>
                <p class="mt-10 font-bold">
                    Napomene :
                </p>
                <br>
                <p>
                    <pre>{{ $ponuda_name->opis }}</pre>
                </p>
            </div>
        @endif
    @endif
    <script>
        function actionSwall(url, name, id, realId) {
            Swal.fire({
                title: 'Stvarno hoćete da izbrišite element ponudu "' + name + '"?',
                icon: 'question',
                html: '<form method="POST" id="delete_item" action="'+url+'">' +
                    '@csrf' +
                    '@method("delete")' +
                    '<input name="id" hidden value="' + id + '">' +
                    '<input name="real_id" hidden value="' + realId + '">' +
                    '<button type="submit" class="add-new-btn mx-1 mt-5">Izbriši</button>' +
                    '</form>',
                showCancelButton: false,
                showConfirmButton: false,
                showCloseButton: true,
            })
        }
    </script>
</x-app-worker-layout>
