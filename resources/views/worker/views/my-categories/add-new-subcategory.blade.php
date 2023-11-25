<x-app-worker-layout>
    <x-slot name="pageTitle">
        {{ __('app.categories.new-subcategory') }}
    </x-slot>
    <x-slot name="header">
        {{ __('app.categories.new-subcategory') }}
    </x-slot>
    <form method="POST" id="add_new_category" class="mt-20" action="{{ route('worker.options.store.new.subcategory') }}">
        @csrf
        <div id="category-dropdown" class="mt-14">
            <span class="input-label pl-2">{{ __('app.create-ponuda.choose-category') }}:</span>
            <div class="select-menu-category pt-3">
                <div class="select-btn-category">
                    <span class="sBtn-text-category">{{ __('app.create-ponuda.choose-category') }}</span>
                    <svg role="img" viewBox="0 0 512 512">
                        <path
                            d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                    </svg>
                </div>
                <ul class="options-category" id="category-ul">
                    <li class="option-subcategory">
                        <input type="text" placeholder="Search.." id="category-search"
                            onkeyup="filterFunctionCategory()" class="w-full dropdown-search">
                    </li>
                    @foreach ($custom_categories as $category)
                        <li class="option-category">
                            <span class="option-text-category">{{ $category->name }}</span>
                            <p class="category-id">{{ $category->id }}</p>
                        </li>
                    @endforeach
                    @foreach ($categories as $category)
                        <li class="option-category">
                            <span class="option-text-category">{{ $category->name }}</span>
                            <p class="category-id">{{ $category->id }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="flex w-full flex-col" style="margin-top: -115px">
                <span class="input-label py-2">{{ __('app.categories.write-name-subcategory') }}:</span>
                <input type="text" name="subcategory_name_sr" class="input-style" id="inputText"
                    oninput="convertToCyrillic(this.value)">

                <span class="input-label py-2 mt-5">{{ __('app.categories.write-name-subcategory') }} ciril:</span>
                <input type="text" class="input-style" name="subcategory_name_rs_cyrl" id="outputText">

                <button type="submit" class="main-btn mx-auto mt-10">{{ __('app.basic.save') }}</button>
            </div>
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

        // category select start

        function filterFunctionCategory() {
            var input, filter, ul, li, a, i;
            input = document.getElementById("category-search");
            filter = input.value.toUpperCase();
            div = document.getElementById("category-ul");
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

        const optionMenuCategory = document.querySelector(".select-menu-category"),
            selectBtnCategory = optionMenuCategory.querySelector(".select-btn-category"),
            optionsCategory = optionMenuCategory.querySelectorAll(".option-category"),
            sBtn_textCategory = optionMenuCategory.querySelector(".sBtn-text-category");


        selectBtnCategory.addEventListener("click", function() {
            var optionMenu = document.querySelector(".select-menu");
            var optionMenuSub = document.querySelector(".select-menu-subcategory");
            var sBtn_textSub = optionMenuSub.querySelector(".sBtn-text-subcategory");
            var sBtn_text = optionMenu.querySelector(".sBtn-text");
            sBtn_textSub.innerText = '{{ __('app.create-ponuda.choose-subcategory') }} ';
            sBtn_text.innerText = '{{ __('app.create-ponuda.choose-pozicija') }} ';
            var existInput = document.getElementById("editField");
            var btn = document.getElementById("btn");
            if (existInput) {
                existInput.remove();
                btn.style.display = "none"
            }
        });

        selectBtnCategory.addEventListener("click", () =>
            optionMenuCategory.classList.toggle("active")
        );
        optionsCategory.forEach((option) => {
            option.addEventListener("click", () => {
                let selectedOptionCategory = option.querySelector(".option-text-category").innerText;
                var selectedOptionIdCategory = option.querySelector(".category-id").innerText;
                var existInput = document.getElementById("category");
                sBtn_textCategory.innerText = selectedOptionCategory;
                if (!existInput) {
                    var div = document.getElementById("category-dropdown");
                    var input = document.createElement("input");
                    var value = document.createTextNode(selectedOptionIdCategory);
                    input.id = "category";
                    input.name = "category";
                    input.type = "text";
                    input.defaultValue = selectedOptionIdCategory;
                    input.value = selectedOptionIdCategory;
                    input.appendChild(value);
                    div.appendChild(input);
                    categoryId = selectedOptionIdCategory;
                } else {
                    existInput.remove();
                    var div = document.getElementById("category-dropdown");
                    var input = document.createElement("input");
                    var value = document.createTextNode(selectedOptionIdCategory);
                    input.id = "category";
                    input.name = "category";
                    input.type = "text";
                    input.defaultValue = selectedOptionIdCategory;
                    input.value = selectedOptionIdCategory;
                    input.appendChild(value);
                    div.appendChild(input);
                    categoryId = selectedOptionIdCategory;
                }
                optionMenuCategory.classList.remove("active");
            });
        });
        // category select end

        function convertToCyrillic(inputText) {
            const cyrillicText = convertLatinToCyrillic(inputText);
            document.getElementById('outputText').value = cyrillicText;
        }

        function convertLatinToCyrillic(inputText) {
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
