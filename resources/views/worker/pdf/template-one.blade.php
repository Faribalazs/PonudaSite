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
        $uniqueName = [];
        $finalPrice = 0;
        $titleBold = 0;
        $company_name = $company->company_name ?? null;
        $company_city = $company->city ?? null;
        $company_logo = null;
        if(isset($company->logo))
            $company_logo = 'data:image/png;base64,'.base64_encode(file_get_contents(storage_path('app/public/'.$company->logo)));
    @endphp
    @if ($mergedData != null)
        @php
            $finalData = $mergedData->sortBy('id')->groupBy('categories_id');
        @endphp
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
                        <p>{{ $company->country }}</p>
                        <p>{{ $company->zip_code }} {{ $company_city }}</p>
                        <p>{{ $company->address }}</p>
                        <p>Tel : {{ $company->phone }}</p>
                        <p>E mail: {{ $company->email }}</p>
                    </div>
                    <div class="right-side">
                        <p>PIB :{{ $company->pib }}</p>
                        <p>Matični broj / Registration code : {{ $company->maticni_broj }}</p>
                        <p>Tekući racun : {{ $company->tekuci_racun }} RSD</p>
                        <p>Bank account : {{ $company->bank_account }} EUR</p>
                        <p>{{ $company->bank_name }}</p>
                        @php
                            \Carbon\Carbon::setLocale(app()->getLocale())
                        @endphp
                        <p>{{ now()->translatedFormat('l jS F Y') }}</p>
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
                    <p>{{ $client->first_name }} {{ $client->last_name }}</p>
                    <p>{{ $client->city }}, {{ $client->address }}, {{ $client->zip_code }}</p>
                    <p>E-mail: {{ $client->email }}</p>
                    <p>Tel: {{ $client->phone }}</p>
                @elseif($type == 2)
                    <p>{{ $client->company_name }}</p>
                    <p>{{ $client->city }}, {{ $client->address }}, {{ $client->zip_code }}</p>
                    <p>E-mail: {{ $client->email }}</p>
                    <p>Tel: +{{ $client->phone }}</p>
                    <p>Pib: {{ $client->pib }}</p>
                @endif
            @endif
            @if(isset($new) && $new !== null)
                @if(request()->type == 1)
                    <p>{{ request()->f_name }} {{ request()->l_name }}</p>
                    <p>{{ request()->city }}, {{ request()->adresa }}, {{ request()->zip }}</p>
                    <p>E-mail: {{ request()->email }}</p>
                    <p>Tel: +{{ request()->phone }}</p>
                @elseif(request()->type == 2)
                    <p>{{ request()->company_name }}</p>
                    <p>{{ request()->city }}, {{ request()->adresa }}, {{ request()->zip }}</p>
                    <p>E-mail: {{ request()->email }}</p>
                    <p>Tel: {{ request()->phone }}</p>
                    <p>Pib: {{ request()->pib }}</p>
                @endif
            @endif
            @foreach ($finalData as $data)
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
                                    <td colspan="8" class="text-left border-bold padding-5"
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
                                <td class="text-left ponuda-table-des"><b>
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
                            </tr>

                                @php 
                                    $finalPrice += $subPrice;
                                @endphp
                                @if ($loop->last)
                                    <tr>
                                        <td colspan="8" class="text-right border-bold whitespace-nowrap px-1">
                                            <b>Svega&nbsp;{{ $name_category }}:</b>&nbsp;{{ number_format($subPrice, 0, ',', ' ') }}&nbsp;RSD
                                        </td>
                                    </tr>
                                @endif
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
                                        <td class="text-left w-100 padding-5">
                                            {{ $name_category_rekapitulacija }}&nbsp;
                                        </td>
                                        <td class="padding-5 text-center no-wrap">
                                            {{ number_format($subPrice, 0, ',', ' ') }}&nbsp;RSD
                                        </td>
                                    </tr>
                                @endif
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
                @if (isset($opis))
                    <p style="font-size: 12px;">
                       <b>Napomene :</b>
                    </p>
                    <br>
                    <p style="margin-top: -15px;">
                        <pre>{{ $opis }}</pre>
                    </p>
                @endif
            </div>
    @endif
    </main>
</body>
</html>
