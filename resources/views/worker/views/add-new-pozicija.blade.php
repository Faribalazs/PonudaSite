<x-app-worker-layout>
    <x-slot name="pageTitle">
        Nova Kategorija
    </x-slot>
    <x-slot name="header">
    </x-slot>
    @php
        $user_id = Auth::guard('worker')->user()->id;
    @endphp
    <form method="POST" id="add_new_category" class="mt-36" action="{{ route('worker.store.new.pozicija') }}">
        @csrf
        {{-- create ponuda szeruen tudjak kivalasztani az alkategoriat --}}
        <div id="subCategory-dropdown">
            <span class="input-label pl-2">Odaberi Podkategoriju:</span>
            <div class="select-menu-subcategory mt-3">
                <div class="select-btn-subcategory">
                    <span class="sBtn-text-subcategory">Izaberi podkategoriju</span>
                    <svg role="img" viewBox="0 0 512 512">
                        <path
                            d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                    </svg>
                </div>
                <ul class="options-subcategory" id="subcategory-ul">
                    <li class="option-subcategory">
                        <input type="text" placeholder="Search.." id="subcategory-filter"
                            onkeyup="filterFunctionSub()" class="w-full dropdown-search">
                    </li>
                    @foreach ($custom_subcategories as $subcategory)
                        <li class="option-subcategory">
                            <span class="option-text-subcategory">{{ $subcategory->name }}</span>
                            <p class="subcategory-id">{{ $subcategory->id }}</p>
                            <p class="sub-id">{{ $subcategory->custom_category_id }}</p>
                        </li>
                    @endforeach
                    @foreach ($subcategories as $subcategory)
                        <li class="option-subcategory">
                            <span class="option-text-subcategory">{{ $subcategory->name }}</span>
                            <p class="subcategory-id">{{ $subcategory->id }}</p>
                            <p class="sub-id">{{ $subcategory->category_id }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div id="obracun-dropdown" class="">
            <span class="input-label pl-2">Odaberi obračun:</span>
            <div class="select-menu-obracun mt-3">
                <div class="select-btn-obracun">
                    <span class="sBtn-text-obracun">Izaberi obračun</span>
                    <svg role="img" viewBox="0 0 512 512">
                        <path
                            d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                    </svg>
                </div>
                <ul class="options-obracun" id="obracun-ul">
                    <li class="option-obracun">
                        <input type="text" placeholder="Search.." id="obracun-filter"
                            onkeyup="filterFunctionObracun()" class="w-full dropdown-search">
                    </li>
                    @foreach ($units as $unit)
                        <li class="option-obracun">
                            <span class="option-text-obracun">{{ $unit->name }}</span>
                            <p class="obracun-id">{{ $unit->id_unit }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="flex flex-col">
            <span class="input-label pl-2 mb-3">Naziv pozicije:</span>
            <input type="text" name="poz_title" class="input-style mb-14">
            <span class="input-label pl-2 mt-3 mb-3">Opis pozicije:</span>
            <textarea name="poz_des" rows="3" class="input-style mb-16"></textarea>
            <button type="submit" class="submit-btn m-auto">Dodaj poziciju</button>
        </div>
    </form>
    <script>
        window.addEventListener('keydown', function(e) {
            if (e.keyIdentifier == 'U+000A' || e.keyIdentifier == 'Enter' || e.keyCode == 13) {
                if (e.target.nodeName == 'INPUT' && e.target.type == 'text') {
                    e.preventDefault();
                    return false;
                }
            }
        }, true);

        // subcategory select start

        function filterFunctionSub() {
            var input, filter, ul, li, a, i;
            input = document.getElementById("subcategory-filter");
            filter = input.value.toUpperCase();
            div = document.getElementById("subcategory-ul");
            a = div.getElementsByTagName("span");
            for (i = 0; i < a.length; i++) {
                if (a[i].parentElement.style.display == "" || a[i].parentElement.style.color == "black") {
                    txtValue = a[i].textContent || a[i].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        a[i].parentElement.style.display = "";
                    } else {
                        a[i].parentElement.style.display = "none";
                        a[i].parentElement.style.color = "black";
                    }
                }
            }
        }

        const optionMenuSub = document.querySelector(".select-menu-subcategory"),
            selectBtnSub = optionMenuSub.querySelector(".select-btn-subcategory"),
            optionsSub = optionMenuSub.querySelectorAll(".option-subcategory"),
            sBtn_textSub = optionMenuSub.querySelector(".sBtn-text-subcategory");
        var selectedOptionId = optionMenuSub.querySelectorAll(".sub-id");

        selectBtnSub.addEventListener("click", function() {
            var optionMenu = document.querySelector(".select-menu");
            var sBtn_text = optionMenuSub.querySelector(".sBtn-text-subcategory");
            sBtn_text.innerText = 'Izaberi Podkategoriju';
            var existInput = document.getElementById("editField");
            var btn = document.getElementById("btn");
            if (existInput) {
                existInput.remove();
                btn.style.display = "none"
            }
        });


        selectBtnSub.addEventListener("click", () =>
            optionMenuSub.classList.toggle("active")
        );
        optionsSub.forEach((option) => {
            option.addEventListener("click", () => {
                let selectedOptionSub = option.querySelector(".option-text-subcategory").innerText;
                var selectedOptionId = option.querySelector(".subcategory-id").innerText;
                var existInput = document.getElementById("subcategory");
                sBtn_textSub.innerText = selectedOptionSub;
                if (!existInput) {
                    var div = document.getElementById("subCategory-dropdown");
                    var input = document.createElement("input");
                    var value = document.createTextNode(selectedOptionId);
                    input.id = "subcategory";
                    input.name = "subcategory";
                    input.type = "text";
                    input.defaultValue = selectedOptionId;
                    input.value = selectedOptionId;
                    input.appendChild(value);
                    div.appendChild(input);
                    subCategoryId = selectedOptionId;
                } else {
                    existInput.remove();
                    var div = document.getElementById("subCategory-dropdown");
                    var input = document.createElement("input");
                    var value = document.createTextNode(selectedOptionId);
                    input.id = "subcategory";
                    input.name = "subcategory";
                    input.type = "text";
                    input.defaultValue = selectedOptionId;
                    input.value = selectedOptionId;
                    input.appendChild(value);
                    div.appendChild(input);
                    subCategoryId = selectedOptionId;
                }
                optionMenuSub.classList.remove("active");
            });
        });
        // subcategory select end

        // obracun select start

        function filterFunctionObracun() {
            var input, filter, ul, li, a, i;
            input = document.getElementById("obracun-filter");
            filter = input.value.toUpperCase();
            div = document.getElementById("obracun-ul");
            a = div.getElementsByTagName("span");
            for (i = 0; i < a.length; i++) {
                if (a[i].parentElement.style.display == "" || a[i].parentElement.style.color == "black") {
                    txtValue = a[i].textContent || a[i].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        a[i].parentElement.style.display = "";
                    } else {
                        a[i].parentElement.style.display = "none";
                        a[i].parentElement.style.color = "black";
                    }
                }
            }
        }

        const optionMenuObracun = document.querySelector(".select-menu-obracun"),
            selectBtnObracun = optionMenuObracun.querySelector(".select-btn-obracun"),
            optionsObracun = optionMenuObracun.querySelectorAll(".option-obracun"),
            sBtn_text_obracun = optionMenuObracun.querySelector(".sBtn-text-obracun");
        var selectedOptionIdObracun = optionMenuObracun.querySelectorAll(".obracun-id");

        selectBtnObracun.addEventListener("click", function() {
            var optionMenu = document.querySelector(".select-menu-obracun");
            var existInput = document.getElementById("editField");
            var btn = document.getElementById("btn");
            if (existInput) {
                existInput.remove();
                btn.style.display = "none"
            }

        });


        selectBtnObracun.addEventListener("click", () =>
            optionMenuObracun.classList.toggle("active")
        );
        optionsObracun.forEach((option) => {
            option.addEventListener("click", () => {
                let selectedOptionObracun = option.querySelector(".option-text-obracun").innerText;
                var selectedOptionId = option.querySelector(".obracun-id").innerText;
                var existInput = document.getElementById("unit_id");
                sBtn_text_obracun.innerText = selectedOptionObracun;
                if (!existInput) {
                    var div = document.getElementById("obracun-dropdown");
                    var input = document.createElement("input");
                    var value = document.createTextNode(selectedOptionId);
                    input.id = "unit_id";
                    input.name = "unit_id";
                    input.type = "hidden";
                    input.defaultValue = selectedOptionId;
                    input.value = selectedOptionId;
                    input.appendChild(value);
                    div.appendChild(input);
                } else {
                    existInput.remove();
                    var div = document.getElementById("obracun-dropdown");
                    var input = document.createElement("input");
                    var value = document.createTextNode(selectedOptionId);
                    input.id = "unit_id";
                    input.name = "unit_id";
                    input.type = "hidden";
                    input.defaultValue = selectedOptionId;
                    input.value = selectedOptionId;
                    input.appendChild(value);
                    div.appendChild(input);
                }
                optionMenuObracun.classList.remove("active");
            });
        });
        // obracun select end
    </script>
</x-app-worker-layout>
