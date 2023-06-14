<x-app-layout>
    <x-slot name="pageTitle">
        Moja Arhiva
    </x-slot>
    <x-slot name="header">
    </x-slot>
    @php
        $i = 1;
        $ponuda_ct = -1;
        $title = '';

        $collection = collect($mergedData);
    @endphp
    @if ($mergedData != null)
        <div class="flex mt-16">
            <div class="flex justify-end w-full">
                <a href="{{ route('worker.archive.pdf', ['id' => $collection->first()->id_ponuda]) }}" Skini class="add-new-btn">Skini PDF</a>
            </div>
        </div>
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
                        <th scope="col">Izbrisi</th>
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
                            <td><button class="delete-btn-table"
                                onclick="actionSwall('{{ route('worker.archive.delete.element', ['ponuda' => $data->id, 'ponuda_id' => $data->ponuda_id]) }}','{{ $data->title }}')">
                                <i class="ri-delete-bin-line"></i>
                            </button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <script>
        function actionSwall(url, name) {
            Swal.fire({
                title: 'Stvarno hocete da izbrisite element ponudu "' + name + '"?',
                icon: 'question',
                confirmButtonText: "Izbrisi",
                cancelButtonText: "Nazad",
                showConfirmButton: true,
                showCancelButton: true,
                showCloseButton: true,
                confirmButtonColor: '#22ff00',
                cancelButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = url;
                }
            })
        }
    </script>
</x-app-layout>
