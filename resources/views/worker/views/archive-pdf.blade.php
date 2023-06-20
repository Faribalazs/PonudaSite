<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<style type="text/css">
    * {
      font-family: "DejaVu Sans Mono", monospace;
      font-size: 8px;
    }

    .ponuda-table , .ponuda-table td , .ponuda-table tr{
        border: 1px solid black;
    }

    .ponuda-table {
        margin-bottom: 30px;
        width: 100%;
        text-align: center;
    }

    .text-left {
        text-align: start !important;
    }

    .text-right {
        text-align: end !important;
    }
  </style>
<body>
    @php
        $i = 1;
        $title = '';
        $collection = collect($mergedData);
        $finalPrice = 0;
        $mergedData = $collection->groupBy('id_category')->toArray();
        $titleBold = 0;
        $subPrice = 0;
        $limit = 0;
        $counter = 0;
    @endphp
    @if ($mergedData != null)
        @foreach ($mergedData as $id)
            <div class="overflow-x-auto">
                <table class="table mt-20 text-center ponuda-table">
                    <thead>
                        <tr>
                            <th scope="col">r.br.</th>
                            <th scope="col">Naziv</th>
                            <th scope="col">j.m.</th>
                            <th scope="col">Količina</th>
                            <th scope="col">jed.cena</th>
                            <th scope="col">ukupno</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($id[0]->name_category))
                            <tr>
                                <td colspan="8" class="text-left">{{ $id[0]->name_category }}</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="8" class="text-left">{{ $id[0]->name_custom_category }}</td>
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
                                <td>{{ $i++ }}</td>
                                @if (isset($data->name_category))
                                    <td class="text-left"><b>{{ $data->title }}</b><br>
                                        @if (isset($data->temporary_description))
                                            {{ $data->temporary_description }} @php $desc_now = $data->temporary_description @endphp
                                            @else{{ $data->description }} @php $desc_now = $data->description @endphp
                                        @endif
                                    </td>
                                    @php
                                        $title = $data->title;
                                    @endphp
                                @else
                                    <td class="text-left"><b>{{ $data->custom_title }}</b><br>
                                        @if (isset($data->temporary_description))
                                            {{ $data->temporary_description }} @php $desc_now = $data->temporary_description @endphp
                                            @else{{ $data->custom_description }} @php $desc_now = $data->custom_description @endphp
                                        @endif
                                    </td>
                                    @php
                                        $title = $data->custom_title;
                                    @endphp
                                @endif
                                <td>{{ $data->unit_name }}</td>
                                <td>{{ $data->quantity }}</td>
                                <td>{{ $data->unit_price }}&nbsp;RSD</td>
                                <td class="whitespace-nowrap">{{ number_format($data->overall_price, 0, ',', ' ') }}
                                    RSD
                                </td>

                            </tr>

                            @if ($limit - 1 == $counter)
                            @php
                            $finalPrice += $subPrice;
                            @endphp
                                @if (isset($data->name_category))
                                    <tr>
                                        <td colspan="8" class="text-right">
                                            <b>Svega&nbsp;{{ $data->name_category }}:</b>&nbsp;{{ $subPrice }}&nbsp;RSD
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="8" class="text-right">
                                            <b>Svega&nbsp;{{ $data->name_custom_category }}</b>:&nbsp;{{ $subPrice }}&nbsp;RSD
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
        <div class="overflow-x-auto">
            <table class="table mt-20 text-center ponuda-table">
                <tr>
                    <td class="text-right">
                        Ukupno:{{$finalPrice}}  RSD
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        @php
                            $pdv = intval($finalPrice) * 0.20;
                        @endphp
                        PDV: {{$pdv}} RSD
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        @php
                            $final = $pdv + $finalPrice;
                        @endphp
                        <b>Ukupno sa PDV:</b> {{$final}}  RSD
                    </td>
                </tr>
            </table>
        </div>
        @endif
</body>
</html>
