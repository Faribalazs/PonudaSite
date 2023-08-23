<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $ponuda_name }}</title>

    <style>
        @page {
            margin: 180px 25px !important;
        }

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

        .logo-side {
            width: 45%;
            float: left;
        }

        .left-side {
            width: 45%;
            float: left;
        }

        .left-side p {
           margin: 3px;
        }

        .right-side {
            width: 45%;
            float: right;
        }

        .right-side p {
            text-align: right;
            margin: 3px;
        }

        .header-style {
            display: block;
            margin-bottom: 100px;
        }

        .name-company {
            width: 45%;
            margin-top: auto;
            float: right;
            padding: 15px;
            border-left: 3px solid rgb(192, 192, 192);
            border-right: 3px solid rgb(192, 192, 192);
            border-radius: 20px;
        }

        .line {
            width: 100%;
            margin-top: 15px;
            border-top: 2px solid rgb(0, 0, 0);
        }

        header {
            position: fixed;
            top: -140px;
            left: 0px;
            right: 0px;
            height: 100px;
            margin-left: 20px;
            margin-right: 20px;
        }

        footer {
            position: fixed;
            bottom: -140px;
            left: 0px;
            right: 0px;
            height: 100px;
            margin-left: 20px;
            margin-right: 20px;
        }
    </style>

</head>

<body style="padding-left: 20px; padding-right: 20px;">
    @php
        $i = 1;
        $title = '';
        $collection = collect($mergedData);
        $finalPrice = 0;
        $mergedData = $collection
            ->sortBy('id')
            ->groupBy('id_category');
        $note = $collection->groupBy('id_category');
        $titleBold = 0;
        $subPrice = 0;
        $limit = 0;
        $counter = 0;
        $user_id = Auth::guard('worker')->user()->id;
        $company_name = isset($company->company_name)?$company->company_name:null;
        $company_city = isset($company->city)?$company->city:null;
        $company_logo = null;
        if(isset($company->logo))
            $company_logo = 'data:image/png;base64,'.base64_encode(file_get_contents(storage_path('app/public/worker/' . $user_id . '/logo' . '/' . $company->logo)));
    @endphp
    @if ($mergedData != null)
        @if($company !== null)
        <header>
            <div style="margin-bottom: 50px;">
                <div class="header-style">
                    <div class="logo-side">
                        <img src="{{ $company_logo }}" alt="{{ $company_name }}" style="object-fit:contain; width:150px; height:80px;">
                    </div>
                    <div class="name-company">
                        <p>{{ $company_name }}</p>
                        <p>{{ $company_city }}</p>
                    </div>
                </div>
                <div class="line"></div>
            </div>
        </header>
        @endif

        <footer>
            <div style="height: 100px">
                <div class="line" style="margin-bottom: 5px;"></div>
                <div class="header-style">
                    @if ($company !== null)
                    <div class="left-side">
                        <p>{{ isset($company->country)?$company->country:null }}</p>
                        <p>{{ isset($company->zip_code)?$company->zip_code:null }} {{ $company_city }}</p>
                        <p>{{ isset($company->address)?$company->address:null }}</p>
                        <p>Tel : +{{ isset($company->tel)?$company->tel:null }}</p>
                        <p>E mail: {{ isset($company->email)?$company->email:null }}</p>
                    </div>
                    <div class="right-side">
                        <p>PIB :{{ isset($company->pib)?$company->pib:null }}</p>
                        <p>Maticni broj / Registration code : {{ isset($company->maticni_broj)?$company->maticni_broj:null }}</p>
                        <p>Tekuci racun : {{ isset($company->tekuci_racun)?$company->tekuci_racun:null }} RSD</p>
                        <p>bank account : {{ isset($company->bank_account)?$company->bank_account:null }} EUR</p>
                        <p>{{ isset($company->bank_name)?$company->bank_name:null }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </footer>

        <main>
            <table class="ponuda-table" style="border:none;">
                <tr style="border:none;">
                    <td class="text-center no-wrap" style="border:none; font-size:13px;">
                        {{ $ponuda_name }}
                    </td>
                </tr>
            </table>
            @if(isset($client) && $client !== null)
                @if($type == 1)
                    <p>Fizicko lice</p>
                    <p>First name: {{ $client->first_name }}</p>
                    <p>Last name: {{ $client->last_name }}</p>
                    <p>City: {{ $client->city }} {{ $client->zip_code }}</p>
                    <p>Address: {{ $client->address }}</p>
                    <p>E-mail: {{ $client->email }}</p>
                    <p>Tel: +{{ $client->tel }}</p>
                @elseif($type == 2)
                    <p>Pravno lice</p>
                    <p>Company name: {{ $client->company_name }}</p>
                    <p>City: {{ $client->city }} {{ $client->zip_code }}</p>
                    <p>Address: {{ $client->address }}</p>
                    <p>E-mail: {{ $client->email }}</p>
                    <p>Tel: +{{ $client->tel }}</p>
                    <p>Pib: {{ $client->pib }}</p>
                @endif
            @endif
            @if(isset($new) && $new !== null)
                @if(request()->type == 1)
                    <p>Fizicko lice</p>
                    <p>First name: {{ request()->f_name }}</p>
                    <p>Last name: {{ request()->l_name }}</p>
                    <p>City: {{ request()->city }} {{ request()->zip }}</p>
                    <p>Address: {{ request()->adresa }}</p>
                    <p>E-mail: {{ request()->email }}</p>
                    <p>Tel: +{{ request()->tel }}</p>
                @elseif(request()->type == 2)
                    <p>Pravno lice</p>
                    <p>Company name: {{ request()->company_name }}</p>
                    <p>City: {{ request()->city }} {{ request()->zip }}</p>
                    <p>Address: {{ request()->adresa }}</p>
                    <p>E-mail: {{ request()->email }}</p>
                    <p>Tel: +{{ request()->tel }}</p>
                    <p>Pib: {{ request()->pib }}</p>
                @endif
            @endif
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
                                        <td class="text-left w-100 padding-5"><b>
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
                                        @php
                                            $title = $data->title;
                                        @endphp
                                    @else
                                        <td class="text-left w-100 padding-5"><b>
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
                <div style="page-break-after:always;"></div>
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
                @if (isset($note->first()[0]->opis))
                    <p class="text-bold" style="font-size: 12px;">
                        Napomene :
                    </p>
                    <br>
                    <p style="margin-top: -15px;">
                        {!! nl2br($note->first()[0]->opis, false) !!}
                    </p>
                @endif
            </div>
    @endif
    </main>
</body>

</html>
