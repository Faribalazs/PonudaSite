<x-worker-profile-layout>
    <x-slot name="pageTitle">
        Moji klijenti
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <div class="flex profile-title">
        <p class="text-3xl font-bold">Moji klijenti</p>
    </div>
    <div class="flex mt-5">
        <div class="flex w-1/2 flex-col text-center border-r-2 border-gray-400">
            <p class="text-3xl font-bold">Fizicka lica</p>
            @if (count($fizicka_lica) > 0)
                <div class="select-menu-fizicka-lica pr-4 mt-4">
                    <div class="select-btn-fizicka-lica">
                        <span class="sBtn-text-fizicka-lica">Pogledaj fizicka lica</span>
                        <svg role="img" viewBox="0 0 512 512">
                            <path
                                d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                        </svg>
                    </div>
                    <ul class="options-fizicka-lica" id="fizicka-lica-ul">
                        <li class="option-fizicka-lica">
                            <input type="text" placeholder="Trazi..." id="fizicka-lica-search"
                                onkeyup="filterFunctionone()" class="w-full dropdown-search">
                        </li>
                        @foreach ($fizicka_lica as $fizicko_lice)
                            <li class="option-fizicka-lica justify-between">
                                <span class="option-text-fizicka-lica">{{ $fizicko_lice->first_name }} {{ $fizicko_lice->last_name }}</span>
                                <a class="edit-btn-table"
                                    href="{{ route('worker.personal.contacts.edit.fizicka', ['id' => $fizicko_lice->id]) }}">
                                    <i class="ri-edit-line"></i>
                                </a>
                            </li>
                        @endforeach
                        <a href="{{ route('worker.personal.contacts.add.individual') }}" class="option-fizicka-lica justify-center add-new-contact-btn">
                            Dodaj fizicko lice
                        </a>
                    </ul>
                </div>
                <script>
                    //fizicka lica dropdown and search start
                    const optionMenu = document.querySelector(".select-menu-fizicka-lica"),
                        selectBtn = optionMenu.querySelector(".select-btn-fizicka-lica"),
                        options = optionMenu.querySelectorAll(".option-fizicka-lica"),
                        sBtn_text = optionMenu.querySelector(".sBtn-text-fizicka-lica");

                    selectBtn.addEventListener("click", () =>
                        optionMenu.classList.toggle("active")
                    );

                    options.forEach((option) => {
                        option.addEventListener("click", () => {
                            let selectedOption = option.querySelector(".option-text-fizicka-lica").innerText;
                            sBtn_text.innerText = selectedOption;

                            optionMenu.classList.remove("active");
                        });
                    });

                    function filterFunctionone() {
                        var input, filter, ul, li, a, i;
                        input = document.getElementById("fizicka-lica-search");
                        filter = input.value.toUpperCase();
                        div = document.getElementById("fizicka-lica-ul");
                        a = div.getElementsByTagName("span");
                        for (i = 0; i < a.length; i++) {
                            txtValue = a[i].textContent || a[i].innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                a[i].parentElement.style.display = "";
                            } else {
                                a[i].parentElement.style.display = "none";
                            }
                        }
                    }
                    //fizicka lica dropdown and search end
                </script>
            @else
                <p class="text-xl flex text-center justify-center mt-4">Nema kontakta</p>
                <div class="add-new-contact-btn flex rounded-md justify-center mt-3 w-3/4 py-2 mx-auto">
                    <a href="{{ route('worker.personal.contacts.add.individual') }}">
                        Dodaj fizicko lice
                    </a>
                </div>
            @endif
        </div>
        <div class="flex w-1/2 flex-col text-center">
            <p class="text-3xl font-bold">Pravna lica</p>
            @if (count($pravna_lica) > 0)
                <div class="select-menu-pravna-lica pl-4 mt-4">
                    <div class="select-btn-pravna-lica">
                        <span class="sBtn-text-pravna-lica">Pogledaj pravna lica</span>
                        <svg role="img" viewBox="0 0 512 512">
                            <path
                                d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                        </svg>
                    </div>

                    <ul class="options-pravna-lica" id="pravna-lica-ul">
                        <li class="option-pravna-lica">
                            <input type="text" placeholder="Search.." id="pravna-lica-search"
                                onkeyup="filterFunctiontwo()" class="w-full dropdown-search">
                        </li>
                        @foreach ($pravna_lica as $pravno_lice)
                            <li class="option-pravna-lica justify-between">
                                <span class="option-text-pravna-lica">{{ $pravno_lice->company_name }}</span>
                                <a class="edit-btn-table"
                                    href="{{ route('worker.personal.contacts.edit.pravna', ['id' => $pravno_lice->id]) }}">
                                    <i class="ri-edit-line"></i>
                                </a>
                            </li>
                        @endforeach
                        <li class="option-pravna-lica add-new-contact-btn">
                            <a href="{{ route('worker.personal.contacts.add.legal-entity') }}">
                                Dodaj pravno lice
                            </a>
                        </li>
                    </ul>
                </div>
                <script>
                    //pravna lica dropdown and search start
                    const optionMenuPravna = document.querySelector(".select-menu-pravna-lica"),
                        selectBtnPravna = optionMenuPravna.querySelector(".select-btn-pravna-lica"),
                        optionsPravna = optionMenuPravna.querySelectorAll(".option-pravna-lica"),
                        sBtn_textPravna = optionMenuPravna.querySelector(".sBtn-text-pravna-lica");

                    selectBtnPravna.addEventListener("click", () =>
                        optionMenuPravna.classList.toggle("active")
                    );

                    optionsPravna.forEach((optionPravna) => {
                        optionPravna.addEventListener("click", () => {
                            let selectedOptionPravna = optionPravna.querySelector(".option-text-pravna-lica").innerText;
                            sBtn_textPravna.innerText = selectedOptionPravna;

                            optionMenuPravna.classList.remove("active");
                        });
                    });

                    function filterFunctiontwo() {
                        var input, filter, ul, li, a, i;
                        input = document.getElementById("pravna-lica-search");
                        filter = input.value.toUpperCase();
                        div = document.getElementById("pravna-lica-ul");
                        a = div.getElementsByTagName("span");
                        for (i = 0; i < a.length; i++) {
                            txtValue = a[i].textContent || a[i].innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                a[i].parentElement.style.display = "";
                            } else {
                                a[i].parentElement.style.display = "none";
                            }
                        }
                    }
                    //pravna lica dropdown and search end
                </script>
            @else
                <p class="text-xl flex text-center justify-center mt-4">Nema kontakta</p>
                <div class="add-new-contact-btn flex rounded-md justify-center mt-3 w-3/4 py-2 mx-auto">
                    <a href="{{ route('worker.personal.contacts.add.legal-entity') }}">
                        Dodaj pravno lice
                    </a>
                </div>
            @endif
        </div>

        {{-- <form method="POST" action="{{ route('worker.personal.contacts.save') }}" class="flex flex-col">
            @csrf
            @if (session()->has('updateClient'))
            @php
                $updateClient = session('updateClient');
            @endphp
            <input class="input-style" name="id" hidden value="{{ $updateClient->id }}" type="text"/>
            <div class="flex flex-lg-row flex-col">
                <div class="flex w-full w-lg-1/2 flex-col pr-2">
                    <label for="f_name" class="text-xl my-3">Ime :</label>
                    <input class="input-style" name="f_name" value="{{ $updateClient->first_name }}" type="text"/>
                </div>
                <div class="flex w-full w-lg-1/2 flex-col pl-2">
                    <label for="l_name" class="text-xl my-3">Prezime :</label>
                    <input class="input-style" name="l_name" value="{{ $updateClient->last_name }}" type="text"/>
                </div>
            </div>

            <label for="grad" class="text-xl my-3">Grad :</label>
            <input class="input-style" name="grad" value="{{ $updateClient->city }}" type="text"/>

            <label for="postcode" class="text-xl my-3">Postanski broj :</label>
            <input class="input-style" name="postcode" value="{{ $updateClient->zip_code }}" type="number"/>

            <label for="adresa" class="text-xl my-3">Adresa :</label>
            <input class="input-style" name="adresa" value="{{ $updateClient->address }}" type="text"/>
            <div class="flex flex-lg-row flex-col">
                <div class="flex w-full w-lg-1/2 flex-col pr-2">
                    <label for="email" class="text-xl my-3">E-mail :</label>
                    <input class="input-style" name="email" value="{{ $updateClient->email }}" type="text"/>
                </div>
                <div class="flex w-full w-lg-1/2 flex-col pl-2">
                    <label for="tel" class="text-xl my-3">Telefon :</label>
                    <input class="input-style" name="tel" value="{{ $updateClient->tel }}" type="number"/>
                </div>
            </div>
            @else
            <div class="flex flex-lg-row flex-col">
                <div class="flex w-full w-lg-1/2 flex-col pr-2">
                    <label for="f_name" class="text-xl my-3">Ime :</label>
                    <input class="input-style" name="f_name" type="text"/>
                </div>
                <div class="flex w-full w-lg-1/2 flex-col pl-2">
                    <label for="l_name" class="text-xl my-3">Prezime :</label>
                    <input class="input-style" name="l_name" type="text"/>
                </div>
            </div>

            <label for="gard" class="text-xl my-3">Grad :</label>
            <input class="input-style" name="grad" type="text"/>

            <label for="postcode" class="text-xl my-3">Postanski broj :</label>
            <input class="input-style" name="postcode" type="number"/>

            <label for="adresa" class="text-xl my-3">Adresa :</label>
            <input class="input-style" name="adresa" type="text"/>
            <div class="flex flex-lg-row flex-col">
                <div class="flex w-full w-lg-1/2 flex-col pr-2">
                    <label for="email" class="text-xl my-3">E-mail :</label>
                    <input class="input-style" name="email" type="text"/>
                </div>
                <div class="flex w-full w-lg-1/2 flex-col pl-2">
                    <label for="tel" class="text-xl my-3">Telefon :</label>
                    <input class="input-style" name="tel" type="number"/>
                </div>
            </div>
            @endif
            <button type="submit" class="finish-btn mt-5 text-xl">Dodaj klijenta</button>
        </form> --}}
    </div>
</x-worker-profile-layout>
