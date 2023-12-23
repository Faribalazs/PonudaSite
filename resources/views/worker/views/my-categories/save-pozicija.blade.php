<x-app-worker-layout>

    <x-slot name="pageTitle">
        {{ __('app.categories.update-position') }}
    </x-slot>
    <x-slot name="header">
        {{ __('app.categories.update-position') }}
    </x-slot>

    @php
        $pozicija_title = $pozicija->custom_title ?? null;
        $pozicija_desc = $pozicija->custom_description === "&nbsp;" ? '' : $pozicija->custom_description;
        $pozicija_unit = $pozicija->unit->name ?? null;
        $pozicija_id = $pozicija->id ?? null;
    @endphp

    @if (count($errors) != 0)
        <script>
            Swal.fire({
                title: "{{ $errors->first() }}",
                icon: "error"
            });
        </script>
    @endif

    <div class="md:flex hidden w-full justify-end mt-5">
        <button type="button" class="delete-btn-table text-white flex gap-2 py-3 md:text-xl text-lg px-8"
            onclick="actionSwall('{{ route('worker.options.delete.pozicija') }}','{{ $pozicija_id }}')">
            {{ __('app.categories.delete-pozicija') }}
            <i class="ri-delete-bin-line"></i>
        </button>
    </div>

    <div class="mt-3">
        <div class="flex w-full">
            <form method="POST" id="formPozicija" action="{{ route('worker.options.update.pozicija') }}"
                class="mt-10 flex flex-col w-full">

                @csrf
                @method('PUT')

                <span class="input-label md:text-xl text-lg py-3">{{ __('app.categories.write-name-position') }}*</span>
                <input type="text" placeholder="{{ $pozicija_title }}" value="{{ $pozicija_title }}" name="title"
                    class="w-full input-style md:text-xl text-lg">

                <span
                    class="input-label py-3 md:text-xl text-lg mt-5">{{ __('app.categories.description-position') }}*</span>
                <textarea type="text" rows="5" value="{{ $pozicija_desc }}" name="description"
                    class="w-full input-style md:text-xl text-lg">{{ $pozicija_desc }}</textarea>

                <label for="unit"
                    class="input-label md:text-xl text-lg py-3 mt-5">{{ __('app.categories.calculation') }}*</label>
                <div class="select-menu" id="dropdown">
                    <div class="select-btn">
                        <span class="sBtn-text">{{ $pozicija_unit }}</span>
                        <svg role="img" viewBox="0 0 512 512">
                            <path
                                d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                        </svg>
                    </div>

                    <div class="relative w-full">
                        <ul class="options">
                            @foreach ($units as $unit)
                                <li class="option">
                                    <span class="option-text">{{ $unit->name }}</span>
                                    <p class="pozicija_id">{{ $unit->id_unit }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <input type="hidden" name="id" value="{{ $pozicija_id }}" class="w-full dropdown-search mt-4">

                <button type="submit"
                    class="main-btn mx-auto md:w-1/2 w-full md:text-xl text-lg md:mt-20 mt-12">{{ __('app.basic.save') }}</button>

                <button type="button"
                    class="delete-btn-table text-white flex gap-2 md:text-xl mt-10 py-3 md:hidden text-lg px-8"
                    onclick="actionSwall('{{ route('worker.options.delete.category') }}','{{ $pozicija_id }}')">
                    {{ __('app.categories.delete-category') }}
                    <i class="ri-delete-bin-line"></i>
                </button>
            </form>
        </div>
    </div>

    <script>
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
                var unitID = option.querySelector(".pozicija_id").innerText;
                sBtn_text.innerText = selectedOption;
                var existInput = document.getElementById("unit");
                if (!existInput) {
                    var div = document.getElementById("dropdown");
                    var input = document.createElement("input");
                    var value = document.createTextNode(unitID);
                    input.id = "unit";
                    input.name = "unit";
                    input.type = "text";
                    input.defaultValue = unitID;
                    input.value = unitID;
                    input.appendChild(value);
                    div.appendChild(input);
                    categoryId = unitID;
                } else {
                    existInput.remove();
                    var div = document.getElementById("dropdown");
                    var input = document.createElement("input");
                    var value = document.createTextNode(unitID);
                    input.id = "unit";
                    input.name = "unit";
                    input.type = "text";
                    input.defaultValue = unitID;
                    input.value = unitID;
                    input.appendChild(value);
                    div.appendChild(input);
                    categoryId = unitID;
                }
                optionMenu.classList.remove("active");
            });
        });

        function actionSwall(url, id) {
            Swal.fire({
                title: '{{ __('app.create-ponuda.swal-are-you-sure-delete') }}?',
                icon: 'question',
                confirmButtonText: "{{ __('app.basic.delete') }}",
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
                    '<button type="submit" class="add-new-btn py-4 px-10 mx-1 mt-5">{{ __('app.basic.delete') }}</button>' +
                    '</form>',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = url;
                }
            })
        }
    </script>

    <style>
        .active .options {
            position: absolute;
        }

        #unit {
            display: none;
        }
    </style>

</x-app-worker-layout>
