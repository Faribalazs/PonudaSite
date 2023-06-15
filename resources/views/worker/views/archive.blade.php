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
        <button type="submit" class="add-new-btn my-3">Trazi</button>
    </form>

    <form method="GET" action="{{ route('worker.archive.search') }}" class="mt-16">
        <div class="select-menu">
            <div class="select-btn">
                <span class="sBtn-text">Sortiraj</span>
                <i class="ri-arrow-down-s-line"></i>
            </div>
            <ul class="options">
                <li class="option">
                    <span class="option-text">Najnoviji</span>
                </li>
                <li class="option">
                    <span class="option-text">Najstariji</span>
                </li>
            </ul>
        </div>
        <select name="sort_order">
            <option value="desc">Najnoviji</option>
            <option value="asc">Najstariji</option>
        </select>
        <button type="submit" class="add-new-btn my-3">Filtriraj</button>
    </form>
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

        const optionMenu = document.querySelector(".select-menu"),
            selectBtn = optionMenu.querySelector(".select-btn"),
            options = optionMenu.querySelectorAll(".option"),
            sBtn_text = optionMenu.querySelector(".sBtn-text");

        selectBtn.addEventListener("click", () =>
            optionMenu.classList.toggle("active")
        );

        options.forEach((option) => {
            option.addEventListener("click", () => {
                let selectedOption = option.querySelector(".option-text").innerText;
                sBtn_text.innerText = selectedOption;

                optionMenu.classList.remove("active");
            });
        });
    </script>
</x-app-layout>
