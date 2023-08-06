<x-app-worker-layout>
    <x-slot name="pageTitle">
        Moja Arhiva
    </x-slot>
    <x-slot name="header">
    </x-slot>
    @php
        $i = 1;
        $ponuda_ct = -1;
        $title = '';
        $collection = collect($data);
        $note = $collection->groupBy('id_category');
    @endphp
    <div class="flex mt-16 filter-search-div">
        <form method="GET" action="{{ route('worker.archive.search') }}" class="">
            @if (isset($search_data))
                <input type="text" name="query" value="{{ $search_data }}" placeholder="Traži po nazivu..."
                    id="search-input">
                <button type="button" onclick="searchIcon()" class="my-3 search-icon-div" id="close">
                    <a href="{{ route('worker.archive') }}">
                        <i class="ri-close-line"></i>
                    </a>
                </button>
                <button type="submit" class="my-3 search-icon hidden" id="search">
                    <i class="ri-search-2-line"></i>
                </button>
            @else
                <input type="text" name="query" placeholder="Traži po nazivu..." id="search-input">
                <button type="submit" class="my-3 search-icon">
                    <i class="ri-search-2-line"></i>
                </button>
            @endif
        </form>

        <form method="GET" action="{{ route('worker.archive.search.napomena') }}" class="">
            @if (isset($search_data_napomena))
                <input type="text" name="query" value="{{ $search_data_napomena }}"
                    placeholder="Traži po napomeni..." id="search_input_napomena">
                <button type="button" onclick="searchIconNapomena()" class="my-3 search-icon-div" id="close_napomena">
                    <a href="{{ route('worker.archive') }}">
                        <i class="ri-close-line"></i>
                    </a>
                </button>
                <button type="submit" class="my-3 search-icon hidden" id="search_napomena">
                    <i class="ri-search-2-line"></i>
                </button>
            @else
                <input type="text" name="query" placeholder="Traži po napomeni..." id="search_input_napomena">
                <button type="submit" class="my-3 search-icon">
                    <i class="ri-search-2-line"></i>
                </button>
            @endif
        </form>

        <form method="GET" action="{{ route('worker.archive.search') }}" class="items-center flex">
            <div class="select-menu-archive">
                <div class="select-btn-archive">
                    @if (isset($sort))
                        @if ($sort == 'asc')
                            <span class="sBtn-text-archive">Najstariji</span>
                        @endif
                        @if ($sort == 'desc')
                            <span class="sBtn-text-archive">Najnoviji</span>
                        @endif
                    @else
                        <span class="sBtn-text-archive">Sortiraj</span>
                    @endif
                    <i class="ri-arrow-down-s-line"></i>
                </div>
                <ul class="options-archive">
                    @if (isset($sort))
                        <a href="{{ route('worker.archive') }}" class="clear-filter">
                            <li class="option-archive">
                                Izbrisi filter
                            </li>
                        </a>
                    @endif
                    <li class="option-archive">
                        <button class="option-text-archive" type="submit">Najnoviji</button>
                    </li>
                    <li class="option-archive">
                        <button class="option-text-archive" type="submit">Najstariji</button>
                    </li>
                </ul>
            </div>

            <div id="filter-div" class="hidden">
            </div>
        </form>
    </div>
    @if ($data != null)
        <div class="flex mt-8 flex-col justify-start">
            @foreach ($data as $ponuda)
                <div class=" justify-between items-center flex p-3 archive-container my-2">
                    <div class="flex w-full">
                        <a class="w-full" href="{{ route('worker.archive.selected', ['id' => $ponuda->id_ponuda]) }}">
                            Naziv : <b>{{ $ponuda->ponuda_name }}</b>
                            <p>
                                Kreirano : <b>{{ date('d.m. Y H:i', strtotime($ponuda->created_at)) }}</b>
                            </p>
                            @if (isset($ponuda->note))
                                <p class="mt-3">
                                    Opis : <b>{!! $ponuda->note !!}</b>
                                </p>
                            @endif
                        </a>
                    </div>
                    <div class="w-full archive-hr-mobile">
                        <hr class="w-full my-3">
                    </div>
                    <div class="flex">
                        <button class="edit-btn-table mr-3"
                            onclick="updateSwall('{{ route('worker.archive.edit', ['ponuda_id' => $ponuda->id_ponuda]) }}','{{ $ponuda->ponuda_name }}')">
                            <i class="ri-edit-line"></i>
                        </button>
                        <a class="share-btn-table mr-3 mobile-show"
                            href="{{ route('worker.archive.view.pdf', ['id' => $ponuda->id_ponuda]) }}">
                            <i class="ri-eye-line"></i>
                        </a>
                        <a class="share-btn-table mr-3 destop-show" target="_blank"
                            href="{{ route('worker.archive.view.pdf', ['id' => $ponuda->id_ponuda]) }}">
                            <i class="ri-eye-line"></i>
                        </a>
                        <a class="share-btn-table mr-3"
                            href="{{ route('worker.archive.create.mail', ['id' => $ponuda->id_ponuda]) }}">
                            <i class="ri-share-line"></i>
                        </a>
                        <button class="delete-btn-table"
                            onclick="actionSwall('{{ route('worker.archive.delete', ['ponuda' => $ponuda->id_ponuda]) }}','{{ $ponuda->ponuda_name }}')">
                            <i class="ri-delete-bin-line"></i>
                        </button>
                    </div>
                </div>
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

        function updateSwall(url, name) {
            Swal.fire({
                title: 'Stvarno hocete da menjate nesto u "' + name + '"?',
                icon: 'question',
                confirmButtonText: "Izmeni",
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

        const optionMenu = document.querySelector(".select-menu-archive"),
            selectBtn = optionMenu.querySelector(".select-btn-archive"),
            options = optionMenu.querySelectorAll(".option-archive"),
            sBtn_text = optionMenu.querySelector(".sBtn-text-archive");

        selectBtn.addEventListener("click", () =>
            optionMenu.classList.toggle("active")
        );

        options.forEach((option) => {
            option.addEventListener("click", () => {
                let selectedOption = option.querySelector(".option-text-archive").innerText;
                sBtn_text.innerText = selectedOption;
                var existInput = document.getElementById("filter");
                var div = document.getElementById("filter-div");
                if (selectedOption == 'Najnoviji') {
                    if (!existInput) {
                        var input = document.createElement("input");
                        input.id = "filter";
                        input.name = "sort_order";
                        input.type = "text";
                        input.defaultValue = "desc";
                        input.value = "desc";
                        div.appendChild(input);

                    } else {
                        var input = document.createElement("input");
                        existInput.remove();
                        input.id = "filter";
                        input.name = "sort_order";
                        input.type = "text";
                        input.defaultValue = "desc";
                        input.value = "desc";
                        div.appendChild(input);
                    }
                } else {
                    if (!existInput) {
                        var input = document.createElement("input");
                        input.id = "filter";
                        input.name = "sort_order";
                        input.type = "text";
                        input.defaultValue = "asc";
                        input.value = "asc";
                        div.appendChild(input);
                    } else {
                        var input = document.createElement("input");
                        existInput.remove();
                        input.id = "filter";
                        input.name = "sort_order";
                        input.type = "text";
                        input.defaultValue = "asc";
                        input.value = "asc";
                        div.appendChild(input);
                    }
                }

                optionMenu.classList.remove("active");
            });
        });

        function searchIcon() {
            var close = document.getElementById("close");
            var search = document.getElementById("search");
            var searchInput = document.getElementById("search-input");
            close.style.display = "none";
            searchInput.value = "";
            search.style.display = "initial";
        }

        function searchIconNapomena() {
            var close = document.getElementById("close_napomena");
            var search = document.getElementById("search_napomena");
            var searchInput = document.getElementById("search_input_napomena");
            close.style.display = "none";
            searchInput.value = "";
            search.style.display = "initial";
        }
    </script>
</x-app-worker-layout>
