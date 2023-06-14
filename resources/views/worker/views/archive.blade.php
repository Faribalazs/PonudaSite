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
    @endphp
    <form method="GET" action="{{ route('worker.archive.search') }}" class="mt-16">
        <input type="text" name="query" id="search-input">
        <select name="sort_order">
            <option value="desc">Najnoviji</option>
            <option value="asc">Najstariji</option>
        </select>
        <button type="submit" class="add-new-btn my-3">Pritrazi</button>
    </form>
    @if ($data != null)
        <div class="flex mt-4 flex-col justify-start">
            <hr>
            @foreach ($data as $ponuda)
                <div class=" h-12 items-center flex">
                    <a href="{{ route('worker.archive.selected', ['id' => $ponuda->id_ponuda]) }}">{{ $ponuda->ponuda_name }}
                        ({{ $ponuda->created_at }})
                    </a>
                    <button class="delete-btn-table"
                        onclick="actionSwall('{{ route('worker.archive.delete', ['ponuda' => $ponuda->id_ponuda]) }}','{{ $ponuda->ponuda_name }}')">
                        <i class="ri-delete-bin-line"></i>
                    </button>
                </div>
                <hr>
            @endforeach
        </div>
    @else
        <div class=" text-2xl flex w-full mt-36">
            <span class="w-full text-center">
                Nismo našli nikakvu ponudu&nbsp;!
            </span>
        </div>
    @endif
    <script>
        function actionSwall(url, name) {
            Swal.fire({
                title: 'Stvarno hocete da izbrisite ponudu "' + name + '"?',
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
