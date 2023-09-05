<x-app-worker-layout>
    <x-slot name="pageTitle">
        Moja Arhiva
    </x-slot>
    <x-slot name="header">
    </x-slot>
    @php
        $ponuda_ct = -1;
        $i = 1;
        $title = '';
        $collection = collect($mergedData);
        $finalPrice = 0;
        $mergedData = $collection->groupBy('id_category');
        $note = $collection->groupBy('id_category');
        $titleBold = 0;
        $subPrice = 0;
        $limit = 0;
        $counter = 0;
    @endphp
    @if ($mergedData != null)
        <div class="flex mt-16">
            <div class="flex justify-center flex-col lg:flex-row w-full items-center gap-4">
                <a href="{{ route('worker.archive.select.contact', ['id' => $collection->first()->id_ponuda]) }}" Skini
                    class="archive-pdf-btn">
                    <i class="ri-download-2-line"></i>Generisi PDF</a>
                <a href="{{ route('worker.archive.create.mail', ['id' => $collection->first()->id_ponuda]) }}" Skini
                    class="archive-pdf-btn">
                    <i class="ri-share-line"></i>Pošalji PDF</a>
                <a target="_blank"
                    href="{{ route('worker.archive.view.pdf', ['id' => $collection->first()->id_ponuda]) }}" Skini
                    class="archive-pdf-btn">
                    <i class="ri-eye-line"></i>Pogledaj PDF</a>
                <a href="{{ route('worker.archive.edit', ['ponuda_id' => $collection->first()->id_ponuda]) }}" Skini
                    class="archive-pdf-btn">
                    <i class="ri-edit-line"></i>Izmeni ponudu</a>
            </div>
        </div>
        <div class="overflow-auto">
            @foreach ($mergedData as $id)
                <table class="ponuda-table w-full mt-5">
                    <thead>
                        <tr>
                            <th scope="col" class="px-1 text-center">r.br.</th>
                            <th scope="col" class="px-1 text-center">Naziv</th>
                            <th scope="col" class="px-1 text-center">j.m.</th>
                            <th scope="col" class="px-1 text-center">količina</th>
                            <th scope="col" class="px-1 text-center">jed.cena</th>
                            <th scope="col" class="px-1 text-center">ukupno</th>
                            <th scope="col" class="px-1 text-center">izbrisi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($id[0]->name_category))
                            <tr>
                                <td colspan="8" class="text-left border-bold padding-5"
                                    style="background-color: rgba(0, 0, 0, 0.05);">
                                    <b>{{ $id[0]->name_category }}</b>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="8" class="text-left border-bold padding-5"
                                    style="background-color: rgba(0, 0, 0, 0.05);">
                                    <b>{{ $id[0]->name_custom_category }}</b>
                                </td>
                            </tr>
                        @endif
                        @php
                            $limit = count($id);
                            $counter = 0;
                            $subPrice = 0;
                            $i = 1;
                        @endphp
                        @foreach ($id as $data)
                            @php
                                $subPrice += $data->overall_price;
                            @endphp
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                @if (isset($data->name_category))
                                    <td class="text-left w-full px-1"><b>
                                            @if (isset($data->temporary_title))
                                                {{ $data->temporary_title }}
                                                @php
                                                    $title = $data->temporary_title;
                                                @endphp
                                            @else
                                                {{ $data->title }} @php
                                                    $title = $data->title;
                                                @endphp
                                            @endif
                                        </b><br>
                                        @if (isset($data->temporary_description))
                                            {{ $data->temporary_description }} @php $desc_now = $data->temporary_description @endphp
                                            @else{{ $data->description }} @php $desc_now = $data->description @endphp
                                        @endif
                                        <br>{{ $data->name_service }}
                                    </td>
                                @else
                                    <td class="text-left w-full px-1"><b>
                                            @if (isset($data->temporary_title))
                                                {{ $data->temporary_title }}
                                                @php
                                                    $title = $data->temporary_title;
                                                @endphp
                                            @else
                                                {{ $data->custom_title }} @php
                                                    $title = $data->custom_title;
                                                @endphp
                                            @endif
                                        </b><br>
                                        @if (isset($data->temporary_description))
                                            {{ $data->temporary_description }} @php $desc_now = $data->temporary_description @endphp
                                            @else{{ $data->custom_description }} @php $desc_now = $data->custom_description @endphp
                                        @endif
                                        <br>{{ $data->name_service }}
                                    </td>
                                @endif
                                <td class="text-center">{{ $data->unit_name }}</td>
                                <td class="text-center">{{ $data->quantity }}</td>
                                <td class="text-center">{{ $data->unit_price }}&nbsp;RSD</td>
                                <td class="whitespace-nowrap px-1 border-left text-center">
                                    {{ number_format($data->overall_price, 0, ',', ' ') }}&nbsp;RSD
                                </td>
                                <td><button class="delete-btn-table mx-auto"
                                        onclick="actionSwall('{{ route('worker.archive.delete.element') }}','{{ $title }}', {{ $data->id }}, {{ $data->ponuda_id }})">
                                        <i class="ri-delete-bin-line"></i>
                                    </button></td>

                            </tr>

                            @if ($limit - 1 == $counter)
                                @php
                                    $finalPrice += $subPrice;
                                @endphp
                                @if (isset($data->name_category))
                                    <tr>
                                        <td colspan="8" class="text-right border-bold whitespace-nowrap px-1">
                                            <b>Svega&nbsp;{{ $data->name_category }}:</b>&nbsp;{{ number_format($subPrice, 0, ',', ' ') }}&nbsp;RSD
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="8" class="text-right border-bold whitespace-nowrap px-1">
                                            <b>Svega&nbsp;{{ $data->name_custom_category }}</b>:&nbsp;{{ number_format($subPrice, 0, ',', ' ') }}&nbsp;RSD
                                        </td>
                                    </tr>
                                @endif
                            @endif
                            @php
                                $counter++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            @endforeach
            <div style="border-right: 1px solid black;">
                <table class="ponuda-table mt-5">
                    <tbody>
                        <tr>
                            <td colspan="8" class="text-left border-bold px-1"
                                style="background-color: rgba(0, 0, 0, 0.05);"><b>Rekapitulacija</b></td>
                        </tr>
                        @foreach ($mergedData as $id)
                            @php
                                $limit = count($id);
                                $counter = 0;
                                $subPrice = 0;
                                $i = 1;
                            @endphp
                            @foreach ($id as $data)
                                @php
                                    $subPrice += $data->overall_price;
                                @endphp

                                @if ($limit - 1 == $counter)
                                    @if (isset($data->name_category))
                                        <tr>
                                            <td class="text-left w-full px-1">
                                                {{ $data->name_category }}&nbsp;
                                            </td>
                                            <td class="px-1 text-center whitespace-nowrap">
                                                {{ number_format($subPrice, 0, ',', ' ') }}&nbsp;RSD
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="text-left w-full px-1">
                                                {{ $data->name_custom_category }}&nbsp;
                                            </td>
                                            <td class="px-1 text-center whitespace-nowrap">
                                                {{ number_format($subPrice, 0, ',', ' ') }}&nbsp;RSD
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                                @php
                                    $counter++;
                                @endphp
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <table class="table mt-20 text-end ponuda-table">
                    <tr>
                        <td class="text-right whitespace-nowrap">
                            <b>UKUPNO: {{ number_format($finalPrice, 0, ',', ' ') }}&nbsp;RSD</b>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right whitespace-nowrap">
                            @php
                                $pdv = intval($finalPrice) * 0.2;
                            @endphp
                            PDV: {{ number_format($pdv, 0, ',', ' ') }}&nbsp;RSD
                        </td>
                    </tr>
                </table>
                <table class="ponuda-table w-full text-center">
                    <tr>
                        <td class="text-center whitespace-nowrap border-bold">
                            @php
                                $final = $pdv + $finalPrice;
                            @endphp
                            <b>Ukupno sa PDV: {{ number_format($final, 0, ',', ' ') }}&nbsp;RSD</b>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        @if (isset($note->first()[0]->opis))
            <div>
                <p class="mt-10 font-bold">
                    Napomene :
                </p>
                <br>
                <p>
                    {!! nl2br($note->first()[0]->opis, false) !!}
                </p>
            </div>
        @endif
    @endif
    <script>
        function actionSwall(url, name, id, realId) {
            Swal.fire({
                title: 'Stvarno hocete da izbrisite element ponudu "' + name + '"?',
                icon: 'question',
                html: '<form method="POST" id="delete_item" action="'+url+'">' +
                    '@csrf' +
                    '@method("delete")' +
                    '<input name="id" hidden value="' + id + '">' +
                    '<input name="real_id" hidden value="' + realId + '">' +
                    '<button type="submit" class="add-new-btn mx-1 mt-5">Izbrisi</button>' +
                    '</form>',
                showCancelButton: false,
                showConfirmButton: false,
                showCloseButton: true,
            })
        }
    </script>
</x-app-worker-layout>
