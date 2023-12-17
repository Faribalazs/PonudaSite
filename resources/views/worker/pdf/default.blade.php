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

    .table-padding {
        padding: 5px 10px;
    }

    .table-padding-small {
        padding: 5px;
    }

    .table-padding-small-x {
        padding-left: 8px;
        padding-right: 8px;
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
        $finalPrice = 0;
        $titleBold = 0;
        $uniqueName = [];
    @endphp
    @if ($mergedData != null)
        @php
            $finalData = $mergedData->sortBy('id')->groupBy('categories_id');
        @endphp
        <table class="ponuda-table">
            <tr>
                <td class="text-center no-wrap">
                    {{ $ponuda_name }}
                </td>
            </tr>
        </table>
        @foreach ($finalData as $data)
            <div style="border-right: 1px solid black;">
                <table class="ponuda-table">
                    @php
                        $subPrice = 0;
                        $i = 1;
                    @endphp
                    @foreach ($data as $item)
                        @php
                            $name_category = $item->name_category != null ? $item->name_category : ($item->name_custom_category != null ? $item->name_custom_category : '');
                            $title = $item->temporary_title != null ? $item->temporary_title : ($item->title != null ? $item->title : ($item->custom_title != null ? $item->custom_title : ''));
                            $desc_now = $item->temporary_description != null ? $item->temporary_description : ($item->description != null ? $item->description : ($item->custom_description != null ? $item->custom_description : ''));
                            $desc_now = $desc_now === '&nbsp;' ? '' : $desc_now;
                            $overall_price = $item->quantity * $item->unit_price;
                            $subPrice += $overall_price;
                        @endphp

                        @if ($name_category != null && !in_array($name_category, $uniqueName))
                            <thead>
                                <tr>
                                    <td colspan="8" class="text-left border-bold padding-5"
                                        style="background-color: rgba(0, 0, 0, 0.05);">
                                        <b>{{ $name_category }}</b>
                                        @php
                                            $uniqueName[] = $name_category;
                                        @endphp
                                    </td>
                                </tr>
                                <tr style="page-break-before: avoid; page-break-after: avoid;">
                                    <th scope="col" class="table-padding-small">
                                        {{ __('app.create-ponuda.table-r-br') }}</th>
                                    <th scope="col" class="table-padding w-100">
                                        {{ __('app.create-ponuda.table-naziv') }}</th>
                                    <th scope="col" class="table-padding-small">
                                        {{ __('app.create-ponuda.table-j-m') }}</th>
                                    <th scope="col" class="table-padding-small">
                                        {{ __('app.create-ponuda.table-kolicina') }}</th>
                                    <th scope="col" class="table-padding">
                                        {{ __('app.create-ponuda.table-jed-cena') }}</th>
                                    <th scope="col" class="table-padding">{{ __('app.create-ponuda.table-ukupno') }}
                                    </th>
                                </tr>
                            </thead>
                        @endif

                        <tbody>
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td class="text-left ponuda-table-des table-padding-small-x">
                                    <b>
                                        {{ $title }}
                                    </b><br>
                                    {{ $desc_now }}
                                    <br>{{ $item->name_service }}
                                </td>
                                <td class="text-center table-padding">{{ $item->unit_name }}</td>
                                <td class="text-center table-padding">{{ $item->quantity }}</td>
                                <td class="text-center table-padding">
                                    {{ number_format($item->unit_price, 2) }}&nbsp;{{ __('app.create-ponuda.table-rsd') }}
                                </td>
                                <td class="table-padding whitespace-nowrap px-1 border-left text-center">
                                    {{ number_format($overall_price, 2) }}&nbsp;{{ __('app.create-ponuda.table-rsd') }}
                                </td>
                            </tr>

                            @if ($loop->last)
                                <tr>
                                    <td colspan="8" class="text-right border-bold whitespace-nowrap px-1">
                                        <b>{{ __('app.create-ponuda.table-svega') }}&nbsp;{{ $name_category }}:</b>&nbsp;{{ number_format($subPrice, 2) }}&nbsp;{{ __('app.create-ponuda.table-rsd') }}
                                    </td>
                                </tr>
                            @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach


        <div style="border-right: 1px solid black;">
            <table class="ponuda-table">
                <tbody>
                    <tr>
                        <td colspan="8" class="text-left table-padding-small-x border-bold padding-5"
                            style="background-color: rgba(0, 0, 0, 0.05);">
                            <b>{{ __('app.create-ponuda.table-rekapitulacija') }}</b>
                        </td>
                    </tr>
                    @foreach ($finalData as $data)
                        @php
                            $subPrice = 0;
                        @endphp
                        @foreach ($data as $rekapitulacija)
                            @php
                                $name_category_rekapitulacija = $rekapitulacija->name_category != null ? $rekapitulacija->name_category : ($rekapitulacija->name_custom_category != null ? $rekapitulacija->name_custom_category : null);
                                $subPrice += $rekapitulacija->quantity * $rekapitulacija->unit_price;
                            @endphp

                            @if ($loop->last)
                                <tr>
                                    <td class="text-left w-100 table-padding-small-x">
                                        {{ $name_category_rekapitulacija }}&nbsp;
                                    </td>
                                    <td class="table-padding-small-x text-center no-wrap">
                                        {{ number_format($subPrice, 2) }}&nbsp;{{ __('app.create-ponuda.table-rsd') }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                        @php
                            $finalPrice += $subPrice;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="overflow-x-auto">
            <table class="table mt-20 text-center ponuda-table" style="text-align: right">
                <tr>
                    <td class="text-right no-wrap table-padding-small-x">
                        <b>{{ __('app.create-ponuda.table-ukupno') }}:
                            {{ number_format($finalPrice, 2) }}&nbsp;{{ __('app.create-ponuda.table-rsd') }}</b>
                    </td>
                </tr>
                <tr>
                    <td class="text-right no-wrap table-padding-small-x">

                        @php
                            $pdv = $finalPrice * 0.2;
                        @endphp

                        {{ __('app.create-ponuda.table-pdv') }}:
                        {{ number_format($pdv, 2) }}&nbsp;{{ __('app.create-ponuda.table-rsd') }}
                    </td>
                </tr>
            </table>
            <table class="ponuda-table">
                <tr>
                    <td class="text-center no-wrap border-bold table-padding-small-x">

                        @php
                            $final = $pdv + $finalPrice;
                        @endphp

                        <b>{{ __('app.create-ponuda.table-ukupno-sa-pdv') }}:
                            {{ number_format($final, 2) }}&nbsp;{{ __('app.create-ponuda.table-rsd') }}</b>
                    </td>
                </tr>
            </table>

            @if (isset($opis))
                <p class="text-bold" style="font-size: 12px;">
                    {{ __('app.archive-selected.note') }}:
                </p>
                <br>
                <p style="margin-top: -15px;">
                    <pre>{{ $opis }}</pre>
                </p>
            @endif

            <div style="float:right;">

                @php
                    if (app()->getLocale() == 'rs-cyrl') {
                        \Carbon\Carbon::setLocale('sr_RS');
                    } else {
                        \Carbon\Carbon::setLocale(app()->getLocale());
                    }
                @endphp

                <p>{{ now()->translatedFormat('l jS F Y') }}</p>
            </div>
        </div>
    @endif
</body>

</html>
