<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
</head>

<body>
    @php
        $i = 1;
        $ponuda_ct = -1;
        $title = '';
    @endphp
    @if ($mergedData != null)
        <div class="overflow-x-auto">
            <table class="table table-striped mt-20 ponuda-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kategorija</th>
                        <th scope="col">Subkategorija</th>
                        <th scope="col">Pozicija</th>
                        <th scope="col">Obracun po</th>
                        <th scope="col">Kolicina</th>
                        <th scope="col">Cena</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mergedData as $data)
                        <tr>
                            <td>{{ $i++ }}</td>
                            @if (isset($data->name_category))
                                <td>{{ $data->name_category }}</td>
                                <td>{{ $data->name_subcategory }}</td>
                                <td>{{ $data->title }}</td>
                            @else
                                <td>{{ $data->name_custom_category }}</td>
                                <td>{{ $data->name_custom_subcategory }}</td>
                                <td>{{ $data->custom_title }}</td>
                            @endif
                            <td>{{ $data->quantity }}</td>
                            <td>{{ $data->unit_price }}</td>
                            <td>{{ $data->overall_price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</body>

</html>
