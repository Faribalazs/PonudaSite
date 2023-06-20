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
    <div class="flex items-center mt-16 filter-search-div">
        <form method="GET" action="{{ route('worker.archive.search') }}" class="">
            <input type="text" name="query" id="search-input">
            <button type="submit" class="add-new-btn my-3">Trazi</button>
        </form>
    
        <form method="GET" action="{{ route('worker.archive.search') }}" class="ml-5 items-center flex">
            <div class="select-menu-archive">
                <div class="select-btn-archive">
                    @if (isset($sort))
                    @if ($sort == "asc")
                        <span class="sBtn-text-archive">Najstariji</span>
                    @endif
                    @if ($sort == "desc")
                        <span class="sBtn-text-archive">Najnoviji</span>
                    @endif
                    @else
                        <span class="sBtn-text-archive">Sortiraj</span>
                    @endif
                    <i class="ri-arrow-down-s-line"></i>
                </div>
                <ul class="options-archive">
                    @if (isset($sort))
                    <li class="option-archive">
                        <a href="{{route('worker.archive')}}" class="option-text-archive">Izbrisi filter</a>
                    </li>
                    @endif
                    <li class="option-archive">
                        <span class="option-text-archive">Najnoviji</span>
                    </li>
                    <li class="option-archive">
                        <span class="option-text-archive">Najstariji</span>
                    </li>
                </ul>
            </div>
            <button type="submit" class="add-new-btn my-3 ml-3">Filtriraj</button>
            <div id="filter-div" class="hidden">
            </div>  
        </form>
    </div>
    @if ($data != null)
        <div class="flex mt-4 flex-col justify-start">
            @foreach ($data as $ponuda)
                <div class=" justify-between items-center flex p-3 archive-container my-2">
                    <a class="w-full" href="{{ route('worker.archive.selected', ['id' => $ponuda->id_ponuda]) }}">
                        Naziv : <b>{{ $ponuda->ponuda_name }}</b>
                        <p>
                            Kreirano : <b>{{ date('d.m. Y H:i', strtotime($ponuda->created_at)) }}</b>
                        </p>
                    </a>
                    <button class="delete-btn-table"
                        onclick="actionSwall('{{ route('worker.archive.delete', ['ponuda' => $ponuda->id_ponuda]) }}','{{ $ponuda->ponuda_name }}')">
                        <i class="ri-delete-bin-line"></i>
                    </button>
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
    </script>
</x-app-layout>
