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
            <table class="table table-striped mt-20 ponuda-table text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Pozicija</th>
                        <th scope="col">Jedinica mere</th>
                        <th scope="col">Kolicina</th>
                        <th scope="col">Cena po jedinici</th>
                        <th scope="col">Ukupno</th>
                        <th scope="col">Izbrisi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mergedData as $data)
                        <tr>
                            <td>{{ $i++ }}</td>
                            @if (isset($data->name_category))
                                <td>{{ $data->title }}<br>@if(isset($data->temporary_description)){{ $data->temporary_description }}@else{{ $data->description }}@endif</td>
                                @php
                                    $title = $data->title;
                                @endphp
                            @else
                                <td>{{ $data->custom_title }}<br>@if(isset($data->temporary_description)){{ $data->temporary_description }}@else{{ $data->custom_description }}@endif</td>
                                @php
                                    $title = $data->custom_title;
                                @endphp
                            @endif
                            <td>{{ $data->unit_name }}</td>
                            <td>{{ $data->quantity }}</td>
                            <td>{{ $data->unit_price }}</td>
                            <td>{{ $data->overall_price }}</td>
                            <td><button class="delete-btn-table"
                                onclick="actionSwall('{{ route('worker.archive.delete.element', ['ponuda' => $data->id, 'ponuda_id' => $data->ponuda_id]) }}','{{ $title }}')">
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
