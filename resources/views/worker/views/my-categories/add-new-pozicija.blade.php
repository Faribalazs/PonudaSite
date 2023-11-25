<x-app-worker-layout>
    <x-slot name="pageTitle">
        {{ __('app.categories.new-pozicija') }}
    </x-slot>
    <x-slot name="header">
        {{ __('app.categories.new-pozicija') }}
    </x-slot>
    <form method="POST" id="add_new_category" class="mt-36" action="{{ route('worker.options.store.new.pozicija') }}">
        @csrf
        {{-- create ponuda szeruen tudjak kivalasztani az alkategoriat --}}
        <div id="subCategory-dropdown">
            <span class="input-label pl-2">{{ __('app.create-ponuda.choose-subcategory') }}:</span>
            <div class="select-menu-subcategory mt-3">
                <div class="select-btn-subcategory">
                    <span class="sBtn-text-subcategory">{{ __('app.create-ponuda.choose-subcategory') }}</span>
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
        <div class="flex flex-col" style="margin-top: -130px">
            <span class="input-label pl-2 mb-3">{{ __('app.create-ponuda.swal-pozicija-name') }}:</span>
            <div class="add-pozicija-section">
                <span class="input-label pl-2 mb-3">{{ __('app.create-ponuda.swal-pozicija-name-latin') }}: *</span>
                <input type="text" name="pozicija_name_sr" class="input-style" id="inputTextName"
                oninput="convertToCyrillicName(this.value)">

                <span class="input-label py-2 pl-2 mt-5">{{ __('app.create-ponuda.swal-pozicija-name-ciril') }}:</span>
                <input type="text" class="input-style" name="pozicija_name_rs_cyrl" id="outputTextName">
            </div>

            <span class="input-label pl-2 mt-20 mb-3">{{ __('app.create-ponuda.swal-pozicija-des') }}:</span>
            <div class="add-pozicija-section">
                <span class="input-label pl-2 mb-3">{{ __('app.create-ponuda.swal-pozicija-des-latin') }}: *</span>
                <textarea name="poz_des_sr" rows="5" class="input-style mb-3" id="inputTextDes" oninput="convertToCyrillicDes(this.value)"></textarea>

                <span class="input-label py-2 pl-2 mt-5">{{ __('app.create-ponuda.swal-pozicija-des-ciril') }}:</span>
                <textarea name="poz_des_rs_cyrl" rows="5" class="input-style" id="outputTextDes"></textarea>
            </div>
        </div>

        <div id="obracun-dropdown" class="mt-20" >
            <span class="input-label pl-2">{{ __('app.categories.choose-calculation') }}:</span>
            <div class="select-menu-obracun mt-3">
                <div class="select-btn-obracun">
                    <span class="sBtn-text-obracun">{{ __('app.categories.choose-calculation') }}</span>
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
        <div class="flex justify-center">
            <button type="submit" class="main-btn mx-auto mt-10">{{ __('app.basic.save') }}</button>
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
            sBtn_text.innerText = '{{ __("app.create-ponuda.choose-subcategory") }}';
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

        function convertToCyrillicName(inputText) {
            const cyrillicText = convertLatinToCyrillicName(inputText);
            document.getElementById('outputTextName').value = cyrillicText;
        }

        function convertLatinToCyrillicName(inputText) {
            const latinToCyrillicMap = {
                'a': 'а', 'b': 'б', 'c': 'ц', 'd': 'д', 'e': 'е', 'f': 'ф', 'g': 'г',
                'h': 'х', 'i': 'и', 'j': 'j', 'k': 'к', 'l': 'л', 'm': 'м', 'n': 'н',
                'o': 'о', 'p': 'п', 'q': 'к', 'r': 'р', 's': 'с', 't': 'т', 'u': 'у',
                'v': 'в', 'w': 'в', 'x': 'кс', 'y': 'y', 'z': 'з',

                'A': 'А', 'B': 'Б', 'C': 'Ц', 'D': 'Д', 'E': 'Е', 'F': 'Ф', 'G': 'Г',
                'H': 'Х', 'I': 'И', 'J': 'J', 'K': 'К', 'L': 'Л', 'M': 'М', 'N': 'Н',
                'O': 'О', 'P': 'П', 'Q': 'К', 'R': 'Р', 'S': 'С', 'T': 'Т', 'U': 'У',
                'V': 'В', 'W': 'В', 'X': 'КС', 'Y': 'Y', 'Z': 'З',
            };

            // Convert each character in the input text
            const cyrillicText = inputText.split('').map(char => {
                // If the character has a mapping, use the Cyrillic equivalent; otherwise, keep the original character
                return latinToCyrillicMap[char] || char;
            }).join('');

            return cyrillicText;
        }

        function convertToCyrillicDes(inputText) {
            const cyrillicText = convertLatinToCyrillicDes(inputText);
            document.getElementById('outputTextDes').value = cyrillicText;
        }

        function convertLatinToCyrillicDes(inputText) {
            const latinToCyrillicMap = {
                'a': 'а', 'b': 'б', 'c': 'ц', 'd': 'д', 'e': 'е', 'f': 'ф', 'g': 'г',
                'h': 'х', 'i': 'и', 'j': 'j', 'k': 'к', 'l': 'л', 'm': 'м', 'n': 'н',
                'o': 'о', 'p': 'п', 'q': 'к', 'r': 'р', 's': 'с', 't': 'т', 'u': 'у',
                'v': 'в', 'w': 'в', 'x': 'кс', 'y': 'y', 'z': 'з',

                'A': 'А', 'B': 'Б', 'C': 'Ц', 'D': 'Д', 'E': 'Е', 'F': 'Ф', 'G': 'Г',
                'H': 'Х', 'I': 'И', 'J': 'J', 'K': 'К', 'L': 'Л', 'M': 'М', 'N': 'Н',
                'O': 'О', 'P': 'П', 'Q': 'К', 'R': 'Р', 'S': 'С', 'T': 'Т', 'U': 'У',
                'V': 'В', 'W': 'В', 'X': 'КС', 'Y': 'Y', 'Z': 'З',
            };

            // Convert each character in the input text
            const cyrillicText = inputText.split('').map(char => {
                // If the character has a mapping, use the Cyrillic equivalent; otherwise, keep the original character
                return latinToCyrillicMap[char] || char;
            }).join('');

            return cyrillicText;
        }
    </script>
</x-app-worker-layout>
