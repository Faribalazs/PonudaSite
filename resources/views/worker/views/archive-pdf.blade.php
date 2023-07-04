<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $ponuda_name }}</title>
</head>
<style type="text/css">
    * {
        font-family: "DejaVu Sans Mono", monospace;
        font-size: 9px;
    }

    .ponuda-table,
    .ponuda-table td,
    .ponuda-table th {
        border: 1px solid black;
        border-collapse: collapse;
    }

    .w-100 {
        width: 100%;
    }

    .ponuda-table {
        margin-bottom: 30px;
        width: 100%;
    }

    .border-left {
        border-right: 1px solid black;
    }

    .text-left {
        text-align: left !important;
    }

    .text-center {
        text-align: center;
    }

    .text-right {
        text-align: right !important;
    }

    .no-wrap {
        white-space: nowrap;
    }

    .padding-5 {
        padding-left: 5px;
        padding-right: 5px;
    }

    .border-bold {
        border: 2px solid black !important;
    }

    .text-bold {
        font-weight: 600;
    }
</style>

<body style="padding-left: 20px; padding-right: 20px;">
    @php
        $i = 1;
        $title = '';
        $collection = collect($mergedData);
        $finalPrice = 0;
        $mergedData = $collection->groupBy('id_category')->toArray();
        $note = $collection->groupBy('id_category');
        $titleBold = 0;
        $subPrice = 0;
        $limit = 0;
        $counter = 0;
    @endphp
    @if ($mergedData != null)
        <table class="ponuda-table">
            <tr>
                <td class="text-center no-wrap">
                    {{ $ponuda_name }}
                </td>
            </tr>
        </table>
        @foreach ($mergedData as $id)
            <div style="border-right: 1px solid black;">
                <table class="ponuda-table">
                    <thead>
                        <tr>
                            <th scope="col" class="padding-5">r.br.</th>
                            <th scope="col" class="padding-5">Naziv</th>
                            <th scope="col" class="padding-5">j.m.</th>
                            <th scope="col" class="padding-5">količina</th>
                            <th scope="col" class="padding-5">jed.cena</th>
                            <th scope="col" class="padding-5">ukupno</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($id[0]->name_category))
                            <tr>
                                <td colspan="8" class="text-left border-bold padding-5"
                                    style="background-color: rgba(0, 0, 0, 0.05);"><b>{{ $id[0]->name_category }}</b>
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
                                    <td class="text-left w-100 padding-5"><b>@if (isset($data->temporary_title)) {{ $data->temporary_title }}
                                        @php
                                            $title = $data->temporary_title
                                        @endphp
                                        @else
                                        {{ $data->title }} @php
                                            $title = $data->title
                                        @endphp @endif</b><br>
                                        @if (isset($data->temporary_description))
                                            {{ $data->temporary_description }} @php $desc_now = $data->temporary_description @endphp
                                            @else{{ $data->description }} @php $desc_now = $data->description @endphp
                                        @endif
                                        <br>{{ $data->name_service }}
                                    </td>
                                    @php
                                        $title = $data->title;
                                    @endphp
                                @else
                                    <td class="text-left w-100 padding-5"><b>@if (isset($data->temporary_title)) {{ $data->temporary_title }}
                                        @php
                                            $title = $data->temporary_title
                                        @endphp
                                        @else
                                        {{ $data->custom_title }} @php
                                            $title = $data->custom_title
                                        @endphp @endif</b><br>
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
                                <td class="no-wrap padding-5 border-left text-center">
                                    {{ number_format($data->overall_price, 0, ',', ' ') }}&nbsp;RSD
                                </td>

                            </tr>

                            @if ($limit - 1 == $counter)
                                @php
                                    $finalPrice += $subPrice;
                                @endphp
                                @if (isset($data->name_category))
                                    <tr>
                                        <td colspan="8" class="text-right border-bold padding-5 no-wrap">
                                            <b>Svega&nbsp;{{ $data->name_category }}:</b>&nbsp;{{ number_format($subPrice, 0, ',', ' ') }}&nbsp;RSD
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="8" class="text-right border-bold padding-5 no-wrap">
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
            </div>
        @endforeach


        <div style="border-right: 1px solid black;">
            <table class="ponuda-table">
                <tbody>
                    <tr>
                        <td colspan="8" class="text-left border-bold padding-5"
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
                                        <td class="text-left w-100 padding-5">
                                            {{ $data->name_category }}&nbsp;
                                        </td>
                                        <td class="padding-5 text-center no-wrap">
                                            {{ number_format($subPrice, 0, ',', ' ') }}&nbsp;RSD
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="text-left w-100 padding-5">
                                            {{ $data->name_custom_category }}&nbsp;
                                        </td>
                                        <td class="padding-5 text-center no-wrap">
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
        <div class="overflow-x-auto">
            <table class="table mt-20 text-center ponuda-table" style="text-align: right">
                <tr>
                    <td class="text-right no-wrap">
                        <b>UKUPNO: {{ number_format($finalPrice, 0, ',', ' ') }}&nbsp;RSD</b>
                    </td>
                </tr>
                <tr>
                    <td class="text-right no-wrap">
                        @php
                            $pdv = intval($finalPrice) * 0.2;
                        @endphp
                        PDV: {{ number_format($pdv, 0, ',', ' ') }}&nbsp;RSD
                    </td>
                </tr>
            </table>
            <table class="ponuda-table">
                <tr>
                    <td class="text-center no-wrap border-bold">
                        @php
                            $final = $pdv + $finalPrice;
                        @endphp
                        <b>Ukupno sa PDV: {{ number_format($final, 0, ',', ' ') }}&nbsp;RSD</b>
                    </td>
                </tr>
            </table>
            @if (isset($note->first()[0]->note))
                <div>
                    <p class="text-bold" style="margin-top: 20px; font-size: 12px;">
                        Napomena :
                    </p>
                    <p>
                        {{ $note->first()[0]->note }}
                    </p>
                </div>
            @endif
        </div>
    @endif
</body>

</html>
