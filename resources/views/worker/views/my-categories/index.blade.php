<x-app-worker-layout>
    <x-slot name="pageTitle">
        Moje kategorije
    </x-slot>
    <x-slot name="header">
        Moje kategorije
    </x-slot>
    @php
        $i = 1;
        $j = 1;
        $k = 1;
    @endphp
    <div class="grid lg:gap-8 gap-5 mt-24 lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 my-category-grid">
        <div class="w-full flex justify-center flex-col item">
            <span class="text-center pb-5 my-category-title"><b>Moje kategorije :</b></span>
            <div class="flex flex-col my-category-list-div">
                <div class="flex overflow-y-scroll overflow-x-hidden h-44 flex-col gap-5">
                    @if (!isset($custom_categories[0]))
                    <span class="text-center my-auto text-lg">Nema dodato kategorija!</span>
                    @endif
                    @foreach ($custom_categories as $custom_category)
                        <div class="flex items-center justify-between pr-3">
                            <div class="my-category-name">
                                <span># {{ $i++ }}&nbsp;</span>
                                <span class="mr-10">{{ $custom_category->name }}</span>
                            </div>
                            <div class="flex">
                                <a class="edit-btn-table mx-2"
                                    href="{{ route('worker.options.show.category', ['category' => $custom_category->id]) }}">
                                    <i class="ri-edit-line"></i>
                                </a>
                                <button class="delete-btn-table"
                                    onclick="actionSwall('{{ route('worker.options.delete.category') }}','{{ $custom_category->id }}')">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="w-full flex justify-center flex-col item">
            <span class="text-center pb-5 my-category-title"><b>Moje podkategorije :</b></span>
            <div class="flex flex-col my-category-list-div">
                <div class="flex overflow-y-scroll overflow-x-hidden h-44 flex-col gap-5">
                    @if (!isset($custom_subcategories[0]))
                        <span class="text-center my-auto text-lg">Nema dodato podkategorija!</span>
                    @endif
                    @foreach ($custom_subcategories as $custom_subcategory)
                        <div class="flex items-center justify-between pr-3">
                            <div>
                                <span># {{ $j++ }}&nbsp;</span>
                                <span class="mr-10">{{ $custom_subcategory->name }}</span>
                            </div>
                            <div class="flex">
                                <a class="edit-btn-table mx-2"
                                    href="{{ route('worker.options.show.subcategory', ['subcategory' => $custom_subcategory->id]) }}">
                                    <i class="ri-edit-line"></i>
                                </a>
                                <button class="delete-btn-table"
                                    onclick="actionSwall('{{ route('worker.options.delete.subcategory') }}','{{ $custom_subcategory->id }}')">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="w-full flex justify-center flex-col item">
            <span class="text-center pb-5 my-category-title"><b>Moje pozicije :</b></span>
            <div class="flex flex-col my-category-list-div">
                <div class="flex overflow-y-scroll overflow-x-hidden h-44 flex-col gap-5">
                    @if (!isset($custom_pozicija[0]))
                        <span class="text-center my-auto text-lg">Nema dodato pozicija!</span>
                    @endif
                    @foreach ($custom_pozicija as $custom_pozicija)
                        <div class="flex items-center justify-between pr-3">
                            <div>
                                <span># {{ $k++ }}&nbsp;</span>
                                <span class="mr-10">{{ $custom_pozicija->custom_title }}</span>
                            </div>
                            <div class="flex">
                                <a class="edit-btn-table mx-2"
                                    href="{{ route('worker.options.show.pozicija', ['pozicija' => $custom_pozicija->id]) }}">
                                    <i class="ri-edit-line"></i>
                                </a>
                                <button class="delete-btn-table"
                                    onclick="actionSwall('{{ route('worker.options.delete.pozicija') }}','{{ $custom_pozicija->id }}')">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="flex items-center flex-col mt-20">
        <div class="mb-10">
            <p class="text-center text-xl font-semibold">
                Dodaj svoju kategoriju/podkategoriju/poziciju radova koju ćeš koristiti za izradu ponude :
            </p>
        </div>
        <div>
            <button onclick="addNewOption()" class="main-btn ml-3">
                Dodaj
            </button>
        </div>
    </div>

    <script>
        function actionSwall(url, id) {
            Swal.fire({
                title: 'Stvarno hoćete da izbrišite?',
                icon: 'question',
                confirmButtonText: "Izbriši",
                cancelButtonText: "Nazad",
                showConfirmButton: false,
                showCancelButton: false,
                showCloseButton: true,
                confirmButtonColor: '#22ff00',
                cancelButtonColor: '#d33',
                html: '<form method="POST" id="delete" action="' + url + '">' +
                    '@csrf' +
                    '@method('put')' +
                    '<input name="id" hidden value="' + id + '">' +
                    '<button type="submit" class="add-new-btn mx-1 mt-5">Izbriši</button>' +
                    '</form>',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = url;
                }
            })
        }
    </script>
    @if ($successMsg == 'kecske' && Auth::guard('worker')->check())
        <script>
            Swal.fire(
                title: 'Uspesno ste izbrisali kategoriju',
                icon: 'success',
                confirmButtonText: "Zatvori",
                showConfirmButton: false,
                showCloseButton: true,
                confirmButtonColor: '#22ff00',
                cancelButtonColor: '#d33',
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
    <script>
        function addNewOption() {
            Swal.fire({
                title: 'Šta želiš da dodaš ?',
                icon: 'question',
                html: '<div class="flex flex-col gap-5 pb-6">' +
                    '<a href="{{ route('worker.create.new.category') }}" class="main-btn">Novu kategoriju</a>' +
                    '<a href="{{ route('worker.create.new.subcategory') }}" class="main-btn">Novu podkategoriju</a>' +
                    '<a href="{{ route('worker.create.new.pozicija') }}" class="main-btn">Novu poziciju</a>' +
                    '</div>',
                showCancelButton: false,
                showConfirmButton: false,
                showCloseButton: true,
                confirmButtonColor: '#22ff00',
                cancelButtonColor: '#d33',
            })
        }
    </script>
</x-app-worker-layout>
