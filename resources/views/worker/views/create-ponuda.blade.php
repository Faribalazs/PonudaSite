<x-app-layout>
    <x-slot name="pageTitle">
        Napravi ponudu
    </x-slot>
    <x-slot name="header">
    </x-slot>
    @php
        $i = 1;
        $title = '';
        $formatedPrice = number_format($subTotal, 0, ',', ' ');
        $desc_now = '';
        $collection = collect($mergedData);
        $mergedData = $collection->groupBy('id_category')->toArray();
        $titleBold = 0;
        $subPrice = 0;
        $limit = 0;
        $counter = 0;
        
    @endphp
    @if ($mergedData != null)
        @foreach ($mergedData as $id)
            <div class="overflow-x-auto">
                <table class="table mt-20 text-center ponuda-table">
                    <thead>
                        <tr>
                            <th scope="col">r.br.</th>
                            <th scope="col">Naziv</th>
                            <th scope="col">j.m.</th>
                            <th scope="col">Količina</th>
                            <th scope="col">jed.cena</th>
                            <th scope="col">ukupno</th>
                            <th scope="col">Izmeni</th>
                            <th scope="col">Izbrisi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($id[0]->name_category))
                            <tr>
                                <td colspan="8" class="bold-title">{{ $id[0]->name_category }}</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="8" class="bold-title">{{ $id[0]->name_custom_category }}</td>
                            </tr>
                        @endif
                        @php
                            $limit = count($id);
                            $counter = 0;
                            $subPrice = 0;
                            $i = 1;
                        @endphp
                        @foreach ($id as $data)
                            @php
                                $subPrice += $data->overall_price;
                            @endphp
                            <tr>
                                <td>{{ $i++ }}</td>
                                @if (isset($data->name_category))
                                    <td class="text-left"><b>{{ $data->title }}</b><br>
                                        @if (isset($data->temporary_description))
                                            {{ $data->temporary_description }} @php $desc_now = $data->temporary_description @endphp
                                            @else{{ $data->description }} @php $desc_now = $data->description @endphp
                                        @endif
                                    </td>
                                    @php
                                        $title = $data->title;
                                    @endphp
                                @else
                                    <td class="text-left"><b>{{ $data->custom_title }}</b><br>
                                        @if (isset($data->temporary_description))
                                            {{ $data->temporary_description }} @php $desc_now = $data->temporary_description @endphp
                                            @else{{ $data->custom_description }} @php $desc_now = $data->custom_description @endphp
                                        @endif
                                    </td>
                                    @php
                                        $title = $data->custom_title;
                                    @endphp
                                @endif
                                <td>{{ $data->unit_name }}</td>
                                <td>{{ $data->quantity }}</td>
                                <td>{{ $data->unit_price }}&nbsp;RSD</td>
                                <td class="whitespace-nowrap">{{ number_format($data->overall_price, 0, ',', ' ') }}
                                    RSD
                                </td>
                                <td>
                                    <button class="edit-btn-table mx-auto"
                                        onclick="UpdateSwall(() => ({ realId: {{ $data->id }}, tempDesc: '{{ $desc_now }}' }))">
                                        <i class="ri-edit-line"></i>
                                    </button>
                                </td>
                                <td>
                                    <button class="delete-btn-table mx-auto"
                                        onclick="actionSwall('{{ route('worker.store.new.ponuda.delete', ['ponuda' => $data->id]) }}','{{ $title }}')">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </td>
                            </tr>

                            @if ($limit - 1 == $counter)
                                @if (isset($data->name_category))
                                    <tr>
                                        <td colspan="8" class="svega-design">
                                            <b>Svega&nbsp;{{ $data->name_category }}:</b>&nbsp;{{ $subPrice }}&nbsp;RSD
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="8" class="svega-design">
                                            <b>Svega&nbsp;{{ $data->name_custom_category }}</b>:&nbsp;{{ $subPrice }}&nbsp;RSD
                                        </td>
                                    </tr>
                                @endif
                            @endif
                            @php
                                $counter++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
        <div class="overflow-x-auto">
            <table class="table mt-20 text-center ponuda-table">
                <tr>
                    <td class="text-right">
                        Ukupno: {{ $formatedPrice }} RSD
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        @php
                            $pdv = intval($subTotal) * 0.20;
                        @endphp
                        PDV: {{ $pdv }} RSD
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        @php
                            $final = $pdv + $subTotal;
                        @endphp
                        <b>Ukupno sa PDV:</b> {{ $final }} RSD
                    </td>
                </tr>
            </table>
        </div>
        <div class="flex w-full justify-center">
            <div class="flex">
                <button onclick="NameSwall()" class="add-new-btn my-3">Zavrsi ponudu</button>
                {{-- <form method="POST" id="formDone" action="{{ route('worker.store.new.ponuda.done') }}">
                    @csrf
                    <button type="submit" class="add-new-btn my-3">Zavrsi ponudu</button>
                </form> --}}
            </div>
        </div>
    @endif
    <form method="POST" id="form" action="{{ route('worker.store.new.ponuda') }}">
        @csrf
        <div id="category-dropdown" class="mt-14">
            <span class="input-label pl-2">Odaberi Kategoriju:</span>
            <div class="select-menu-category pt-3">
                <div class="select-btn-category">
                    <span class="sBtn-text-category">Izaberi kategoriju</span>
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
        </div>
        <div id="subCategory-dropdown" class="category-div">
            <span class="input-label pl-2">Odaberi Subkategoriju:</span>
            <div class="select-menu-subcategory mt-3">
                <div class="select-btn-subcategory">
                    <span class="sBtn-text-subcategory">Izaberi subkategoriju</span>
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
        <div id="poz-dropdown" class="category-div">
            <span class="input-label pl-2">Odaberi Poziciju:</span>
            <div class="select-menu mt-3">
                <div class="select-btn">
                    <span class="sBtn-text">Izaberi poziciju</span>
                    <svg role="img" viewBox="0 0 512 512">
                        <path
                            d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                    </svg>
                </div>
                <ul class="options" id="poz-ul">
                    <li class="option-subcategory">
                        <input type="text" placeholder="Search.." id="poz-filter" onkeyup="filterFunctionPoz()"
                            class="w-full dropdown-search">
                    </li>
                    @foreach ($custom_pozicija as $poz)
                        <li class="option">
                            <span class="option-text">{{ $poz->custom_title }}</span>
                            <input class="poz-value" hidden value="{{ $poz->custom_description }}">
                            <p class="poz-id">{{ $poz->custom_subcategory_id }}</p>
                            <p class="poz-unit">{{ $poz->name }}</p>
                            <p class="pozicija_id">{{ $poz->id }}</p>
                        </li>
                        <hr>
                    @endforeach
                    @foreach ($pozicija as $poz)
                        <li class="option">
                            <span class="option-text">{{ $poz->title }}</span>
                            <input class="poz-value" hidden value="{{ $poz->description }}">
                            <p class="poz-id">{{ $poz->subcategory_id }}</p>
                            <p class="poz-unit">{{ $poz->name }}</p>
                            <p class="pozicija_id">{{ $poz->id }}</p>
                        </li>
                        <hr>
                    @endforeach
                </ul>
            </div>
            <div id="clear-btn" class="category-div">
                <div class="flex justify-end">
                    <button id="btn" type="button" onclick="clearData()"
                        class="del-btn my-3">Izbrisi</button>
                </div>
            </div>
            <div class="quantity-div" id="quantity-input">
                <div id="quantity-text" class="mt-5">
                </div>
                <input type="number" name="quantity" class="quantity-input mt-3 mb-1">
                <div class="mt-5">
                    <span>Cena (RSD)</span>
                </div>
                <input type="number" name="price" class="quantity-input mt-3 mb-1">
            </div>
        </div>
        <div id="add-new" class="category-div">
            <div class="flex justify-center">
                <button type="submit" class="add-new-btn my-3">Dodaj element</button>
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

        var numberInputs = document.querySelectorAll('input[type="number"]');
        for (var i = 0; i < numberInputs.length; i++) {
            numberInputs[i].addEventListener("wheel", function(event) {
                event.preventDefault();
            });
        }

        let categoryId = "";
        let subCategoryId = "";
        let pozicijaId = "";

        function actionSwall(url, name) {
            Swal.fire({
                title: 'Sigurni ste da hocete da izbrisete "' + name + '"?',
                icon: 'question',
                confirmButtonText: "Izbrisi",
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

        function UpdateSwall(getData) {
            var {
                realId,
                tempDesc
            } = getData();
            Swal.fire({
                title: 'Izmeni deskripciju',
                icon: 'question',
                html: '<form method="POST" id="updateDescription" action="{{ route('worker.store.new.update.desc') }}">' +
                    '@csrf' +
                    '<span>Unesite novu deskripciju:</span>' +
                    '<input name="real_id" hidden value="' + realId + '">' +
                    '<textarea class="mt-3 swal-input" rows="4" cols="50" type="text" name="new_description" id="updateData">'+tempDesc+'</textarea>' +
                    '<button id="btn" type="button" onclick="clearUpdateData()" class="del-btn-swal my-3 mx-1">Izbrisi</button>' +
                    '<button type="submit" class="add-new-btn my-3 mx-1">Zavrsi</button>' +
                    '</form>',
                showCancelButton: false,
                showConfirmButton: false,
                showCloseButton: true,
                confirmButtonColor: '#22ff00',
                cancelButtonColor: '#d33',
            })
        }

        function NameSwall() {
            Swal.fire({
                title: 'Sacuvaj ponudu',
                icon: 'question',
                html: '<form method="POST" id="formDone" action="{{ route('worker.store.new.ponuda.done') }}">' +
                    '@csrf' +
                    '<span>Unesite ime ponude:</span>' +
                    '<input class="mt-3 swal-input" type="text" name="ponuda_name"/>' +
                    '<button type="submit" class="add-new-btn my-3">Zavrsi ponudu</button>' +
                    '</form>',
                showCancelButton: false,
                showConfirmButton: false,
                showCloseButton: true,
                confirmButtonColor: '#22ff00',
                cancelButtonColor: '#d33',
            })
        }

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
            sBtn_textSub.innerText = 'Izaberi subkategoriju ';
            sBtn_text.innerText = 'Izaberi poziciju';
            var existInput = document.getElementById("editField");
            var btn = document.getElementById("btn");
            var unit = document.getElementById("unit");
            var existPozId = document.getElementById("pozicija_id");
            var quantity = document.getElementById("quantity-input");
            if (existInput) {
                existInput.remove();
                unit.remove();
                existPozId.remove();
                quantity.classList.remove("show-div");
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
                var category = document.getElementById("subCategory-dropdown");
                category.classList.add("show-div");
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
            var sBtn_text = optionMenu.querySelector(".sBtn-text");
            sBtn_text.innerText = 'Izaberi poziciju';
            var existInput = document.getElementById("editField");
            var btn = document.getElementById("btn");
            var unit = document.getElementById("unit");
            var existPozId = document.getElementById("pozicija_id");
            var quantity = document.getElementById("quantity-input");
            if (existInput) {
                existInput.remove();
                unit.remove();
                existInput.remove();
                quantity.classList.remove("show-div");
                btn.style.display = "none";
            }
            for (var i = 0; i < selectedOptionId.length; i++) {
                var sebId = selectedOptionId[i].innerText;
                if (sebId !== categoryId) {
                    selectedOptionId[i].parentElement.style.display = "none";
                    selectedOptionId[i].parentElement.style.color = ""
                } else {
                    selectedOptionId[i].parentElement.style.display = "";
                    selectedOptionId[i].parentElement.style.color = "black"
                }
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
                var pozicija = document.getElementById("poz-dropdown");
                pozicija.classList.add("show-div");
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

        // pozicije select start

        function filterFunctionPoz() {
            var input, filter, ul, li, a, i;
            input = document.getElementById("poz-filter");
            filter = input.value.toUpperCase();
            div = document.getElementById("poz-ul");
            a = div.getElementsByTagName("span");
            hr = div.getElementsByTagName("hr");
            for (i = 0; i < a.length; i++) {
                if (a[i].parentElement.style.display == "" || a[i].parentElement.style.color == "black") {
                    txtValue = a[i].textContent || a[i].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        a[i].parentElement.style.display = "";
                        a[i].parentElement.style.color = "";
                        hr[i].style.display = "";
                    } else {
                        a[i].parentElement.style.display = "none";
                        hr[i].style.display = "none";
                        a[i].parentElement.style.color = "black";
                    }
                }
            }
        }

        const optionMenu = document.querySelector(".select-menu"),
            selectBtn = optionMenu.querySelector(".select-btn"),
            options = optionMenu.querySelectorAll(".option"),
            sBtn_text = optionMenu.querySelector(".sBtn-text");
        var selectedPozId = optionMenu.querySelectorAll(".poz-id");


        selectBtn.addEventListener("click", function() {
            var btn = document.getElementById("btn");
            btn.style.display = ""
            for (var i = 0; i < selectedPozId.length; i++) {
                var pozId = selectedPozId[i].innerText;
                if (pozId !== subCategoryId) {
                    selectedPozId[i].parentElement.style.display = "none";
                    selectedPozId[i].parentElement.style.color = ""
                    div = document.getElementById("poz-ul");
                    hr = div.getElementsByTagName("hr");
                    hr[i].style.display = "none";
                } else {
                    selectedPozId[i].parentElement.style.display = "";
                    selectedPozId[i].parentElement.style.color = "black"
                    div = document.getElementById("poz-ul");
                    hr = div.getElementsByTagName("hr");
                    hr[i].style.display = "";
                }
            }
        });


        selectBtn.addEventListener("click", () =>
            optionMenu.classList.toggle("active")
        );
        options.forEach((option) => {
            option.addEventListener("click", () => {
                let selectedOption = option.querySelector(".option-text").innerText;
                var selectedValue = option.querySelector(".poz-value").value;
                var unitValue = option.querySelector(".poz-unit").innerText;
                var unitID = option.querySelector(".pozicija_id").innerText;
                var btn = document.getElementById("add-new");
                var clearBtn = document.getElementById("clear-btn");
                var existInput = document.getElementById("editField");
                var existInputTitle = document.getElementById("editTitle");
                var existUnit = document.getElementById("unit");
                var existPozId = document.getElementById("pozicija_id");
                sBtn_text.innerText = selectedOption;
                var quantityInput = document.getElementById("quantity-input");
                var textDiv = document.getElementById("quantity-text");
                quantityInput.classList.add("show-div");
                btn.classList.add("show-div");
                clearBtn.classList.add("show-div");
                if (!existInput || !existInputTitle) {
                    var div = document.getElementById("clear-btn");
                    var input = document.createElement("textarea");
                    var pozID = document.createElement("input");
                    pozID.defaultValue = unitID;
                    pozID.type = "hidden";
                    pozID.name = "pozicija_id"
                    pozID.id = "pozicija_id"
                    textDiv.appendChild(pozID);
                    var span = document.createElement("span");
                    span.id = "unit";
                    span.innerText = "Upisi kolicinu ( " + unitValue + " )";
                    textDiv.appendChild(span);
                    var span_div = document.getElementById("quantity-input");
                    var inputValue = document.createElement("input");
                    var inputTitle = document.createTextNode(selectedOption);
                    var value = document.createTextNode(selectedValue);
                    inputValue.id = "editTitle";
                    inputValue.name = "edit-title";
                    inputValue.defaultValue = selectedOption;
                    inputValue.type = "hidden";
                    div.appendChild(inputValue);
                    input.id = "editField";
                    input.name = "edit_des";
                    input.cols = 50;
                    input.rows = 6;
                    input.appendChild(value);
                    div.appendChild(input);
                } else {
                    existInput.remove();
                    existUnit.remove();
                    existPozId.remove();
                    var div = document.getElementById("clear-btn");
                    var input = document.createElement("textarea");
                    var pozID = document.createElement("input");
                    pozID.defaultValue = unitID;
                    pozID.type = "hidden";
                    pozID.name = "pozicija_id"
                    pozID.id = "pozicija_id"
                    textDiv.appendChild(pozID);
                    var span = document.createElement("span");
                    span.id = "unit";
                    span.innerText = "Upisi kolicinu ( " + unitValue + " )";
                    textDiv.appendChild(span);
                    var span_div = document.getElementById("quantity-input");
                    var inputValue = document.createElement("input");
                    var inputvalue = document.createTextNode(selectedOption);
                    var value = document.createTextNode(selectedValue);
                    inputValue.id = "editTitle";
                    inputValue.name = "edit-title";
                    inputValue.defaultValue = selectedOption;
                    inputValue.type = "hidden";
                    div.appendChild(inputValue);
                    input.id = "editField";
                    input.name = "edit_des";
                    input.cols = 50;
                    input.rows = 6;
                    input.appendChild(value);
                    div.appendChild(input);
                }
                optionMenu.classList.remove("active");
            });
        });

        // pozicije select end

        const category = document.getElementById('category-dropdown');
        const subcategoryclick = document.getElementById('subCategory-dropdown');
        const pozclick = document.getElementById('poz-dropdown');

        document.addEventListener('click', event => {
            const isClickInside = category.contains(event.target);
            const isClickInsideSub = subcategoryclick.contains(event.target);
            const isClickInsidePoz = pozclick.contains(event.target);

            if (!isClickInside) {
                optionMenuCategory.classList.remove("active");
            }
            if (!isClickInsideSub) {
                optionMenuSub.classList.remove("active");
            }
            if (!isClickInsidePoz) {
                optionMenu.classList.remove("active");
            }
        })

        function show() {
            var category = document.getElementById("category-dropdown");
            category.classList.add("show-div");
        }

        function clearData() {
            var textarea = document.getElementById("editField");
            textarea.value = '';
        }

        function clearUpdateData() {
            document.getElementById("updateData").value = '';
        }
    </script>
</x-app-layout>
