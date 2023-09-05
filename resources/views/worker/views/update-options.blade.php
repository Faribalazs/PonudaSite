<x-app-worker-layout>
    <x-slot name="pageTitle">
        Update opcije
    </x-slot>
    <x-slot name="header">
    </x-slot>
    @php
        $i = 1;
        $j = 1;
        $k = 1;
    @endphp
    <div class="mt-16 mb-2 category-con">
        <span><b>Moje kategorije :</b></span>
        <div class="flex">
            @if ($custom_categories == [])
                <span class="mt-3">Nema dodato kategorija!</span>
            @endif
            @foreach ($custom_categories as $custom_category)
                <div class="flex items-center justify-center">
                    <span># {{ $i++ }}&nbsp;</span>
                    <span class="mr-10">{{ $custom_category->name }}</span>
                    <a class="edit-btn-table mx-2"
                        href="{{ route('worker.options.show.category', ['category' => $custom_category->id]) }}">
                        <i class="ri-edit-line"></i>
                    </a>
                    <button class="delete-btn-table"
                        onclick="actionSwall('{{ route('worker.options.delete.category') }}','kategoriju','{{ $custom_category->name }}','{{ $custom_category->id }}')">
                        <i class="ri-delete-bin-line"></i>
                    </button>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-8 category-con">
        <span><b>Moje podkategorije :</b></span>
        <div class="flex">
            @if ($custom_subcategories == [])
                <span class="mt-3">Nema dodato podkategorija!</span>
            @endif
            @foreach ($custom_subcategories as $custom_subcategory)
                <div class="flex items-center justify-center">
                    <span># {{ $j++ }}&nbsp;</span>
                    <span class="mr-10">{{ $custom_subcategory->name }}</span>
                    <a class="edit-btn-table mx-2"
                        href="{{ route('worker.options.show.subcategory', ['subcategory' => $custom_subcategory->id]) }}">
                        <i class="ri-edit-line"></i>
                    </a>
                    <button class="delete-btn-table"
                        onclick="actionSwall('{{ route('worker.options.delete.subcategory') }}','subkategoriju','{{ $custom_subcategory->name }}', {{ $custom_subcategory->id }})">
                        <i class="ri-delete-bin-line"></i>
                    </button>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-8 category-con">
        <span><b>Moje pozicije : </b></span>
        <div class="flex">
            @if ($custom_pozicija == [])
                <span class="mt-3">Nema dodato pozicija!</span>
            @endif
            @foreach ($custom_pozicija as $custom_pozicija)
                <div class="flex items-center justify-center">
                    <span># {{ $k++ }}&nbsp;</span>
                    <span class="mr-10">{{ $custom_pozicija->custom_title }}</span>
                    <a class="edit-btn-table mx-2"
                        href="{{ route('worker.options.show.pozicija', ['pozicija' => $custom_pozicija->id]) }}">
                        <i class="ri-edit-line"></i>
                    </a>
                    <button class="delete-btn-table"
                        onclick="actionSwall('{{ route('worker.options.delete.pozicija') }}','poziciju','{{ $custom_pozicija->custom_title }}','{{ $custom_pozicija->id }}')">
                        <i class="ri-delete-bin-line"></i>
                    </button>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function actionSwall(url, option, name, id) {
            Swal.fire({
                title: 'Stvarno hocete da izbrisite ' + option + ' "' + name + '"?',
                icon: 'question',
                confirmButtonText: "Izbrisi",
                cancelButtonText: "Nazad",
                showConfirmButton: false,
                showCancelButton: false,
                showCloseButton: true,
                confirmButtonColor: '#22ff00',
                cancelButtonColor: '#d33',
                html: '<form method="POST" id="delete" action="'+url+'">' +
                    '@csrf' +
                    '@method("put")' +
                    '<input name="id" hidden value="' + id + '">' +
                    '<button type="submit" class="add-new-btn mx-1 mt-5">Izbrisi</button>' +
                    '</form>',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = url;
                }
            })
        }
    </script>
    @if ($successMsg == 'kecske' && !empty($name) && !empty($old_name) && Auth::guard('worker')->check())
        <script>
            Swal.fire(
                'You have successfully updated: {{ $old_name }}',
                'The new name: {{ $name }}',
                'success'
            )
        </script>
    @endif
    @if ($successMsg == 'cica' && !empty($name) && Auth::guard('worker')->check())
        <script>
            Swal.fire(
                'You have successfully deleted: {{ $name }}',
                '',
                'info'
            )
        </script>
    @endif
</x-app-worker-layout>
