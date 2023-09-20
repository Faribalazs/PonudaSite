<x-app-worker-layout>
    <x-slot name="pageTitle">
        Napravi ponudu
    </x-slot>
    <x-slot name="header">
    </x-slot>
    @php
        $finalPrice = 0;
        $titleBold = 0;
        $subPrice = 0;
        $tempPonudaName = null;
        $tempOpis = null;
        $tempNote = null;
        $finished_note = null; 
        $uniqueName = [];
    @endphp
    @foreach ($swap as $s)
        @php
            $tempPonudaName = $s->temp_ponuda_name;
            $tempOpis = $s->temp_opis;
            $tempNote = $s->temp_note;
        @endphp
    @endforeach
    @if (Session::has('msg'))
        <script>
            Swal.fire({
                title: 'Uspesno dodato!',
                icon: 'success',
                showCancelButton: true,
                confirmButtonText: 'Zavrsi ponudu',
                cancelButtonText: 'Dodaj novu poziciju',
                reverseButtons: true,
                allowEscapeKey: false,
                allowOutsideClick: false,
                allowEnterKey: false,
                didClose: () => window.scrollTo({
                    top: document.body.scrollHeight, 
                    behavior: 'smooth'
                })
            }).then((result) => {
                if (result.isConfirmed) {
                    EndPonuda('{{ $tempPonudaName }}');
                }
            })
        </script>
        @php
            Session::forget('msg');
        @endphp
    @endif
    @if ($mergedData->isNotEmpty())
    @php
        $finalData = $mergedData->sortBy('id')->groupBy('categories_id');
    @endphp
        <div class="overflow-x-auto">
            @foreach ($finalData as $data)
                    <table class="table mt-20 text-center ponuda-table">
                        <thead>
                            <tr>
                                <th class="p-2" scope="col">r.br.</th>
                                <th class="p-2" scope="col">Naziv</th>
                                <th class="p-2" scope="col">j.m.</th>
                                <th class="p-2" scope="col">Količina</th>
                                <th class="p-2" scope="col">jed.cena</th>
                                <th class="p-2" scope="col">ukupno</th>
                                <th class="p-2" scope="col">izmeni</th>
                                <th class="p-2" scope="col">izbrisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $subPrice = 0;
                                $i = 1;
                            @endphp
                            @foreach ($data as $item)
                                @php
                                    $name_category = $item->name_category != null ? $item->name_category : ($item->name_custom_category != null ? $item->name_custom_category : ''); 
                                    $title = $item->temporary_title != null ? $item->temporary_title : ($item->title != null ? $item->title : ($item->custom_title != null ? $item->custom_title : ''));
                                    $desc_now = $item->temporary_description != null ? $item->temporary_description : ($item->description != null ? $item->description : ($item->custom_description != null ? $item->custom_description : ''));
                                @endphp
                                @if ($name_category != null && !in_array($name_category, $uniqueName))
                                    <tr>
                                        <td colspan="8" class="text-left border-bold padding-5"
                                            style="background-color: rgba(0, 0, 0, 0.05);">
                                            <b>{{ $name_category }}</b>
                                            @php
                                                $uniqueName[] = $name_category;
                                            @endphp
                                        </td>
                                    </tr>
                                @endif
                                @php
                                    $subPrice += $item->overall_price;
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-left ponuda-table-des"><b>
                                        {{ $title }}
                                        </b><br>
                                        {{ $desc_now }}
                                        <br>{{ $item->name_service }}
                                    </td>
                                    <td class="text-center">{{ $item->unit_name }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-center">{{ $item->unit_price }}&nbsp;RSD</td>
                                    <td class="whitespace-nowrap px-1 border-left text-center">
                                        {{ number_format($item->overall_price, 0, ',', ' ') }}&nbsp;RSD
                                    </td>
                                    <td>
                                        <button class="edit-btn-table mx-auto"
                                            onclick="UpdateSwall(() => ({ realId: {{ $item->id }}, tempDesc: '{{ $desc_now }}', tempTitle: '{{ $title }}', quantity: '{{ $item->quantity }}', unit_price: '{{ $item->unit_price }}', radioBtn: '{{ $item->service_id }}' }))">
                                            <i class="ri-edit-line"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="delete-btn-table mx-auto"
                                            onclick="actionSwall('{{ route('worker.store.new.ponuda.delete') }}','{{ $title }}',{{ $item->id }})">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </td>
                                </tr>
                            
                                @if ($loop->last)
                                    <tr>
                                        <td colspan="8" class="text-right border-bold whitespace-nowrap px-1">
                                            <b>Svega&nbsp;{{ $name_category }}:</b>&nbsp;{{ number_format($subPrice, 0, ',', ' ') }}&nbsp;RSD
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
            @endforeach
            <div>
                <table class="ponuda-table mt-5">
                    <tbody>
                        <tr>
                            <td colspan="8" class="text-left border-bold px-1"
                                style="background-color: rgba(0, 0, 0, 0.05);"><b>Rekapitulacija</b></td>
                        </tr>
                        @foreach ($finalData as $data)
                            @php
                                $subPrice = 0;
                            @endphp
                            @foreach ($data as $rekapitulacija)
                                @php
                                    $name_category_rekapitulacija = $rekapitulacija->name_category != null ? $rekapitulacija->name_category : ($rekapitulacija->name_custom_category != null ? $rekapitulacija->name_custom_category : null); 
                                    $subPrice += $rekapitulacija->overall_price;
                                @endphp
                                @if ($loop->last)
                                    <tr>
                                        <td class="text-left w-full px-1">
                                            {{ $name_category_rekapitulacija }}&nbsp;
                                        </td>
                                        <td class="px-1 text-center whitespace-nowrap">
                                            {{ number_format($subPrice, 0, ',', ' ') }}&nbsp;RSD
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            @php
                                $finalPrice += $subPrice;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <table class="table mt-20 text-center ponuda-table w-full mb-7">
                    <tr>
                        <td class="text-right">
                            <b>Ukupno: {{ number_format($finalPrice, 0, ',', ' ') }}&nbsp;RSD</b>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">
                            @php
                                $pdv = intval($finalPrice) * 0.2;
                            @endphp
                            PDV: {{ number_format($pdv, 0, ',', ' ') }} RSD
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">
                            @php
                                $final = $pdv + $finalPrice;
                            @endphp
                            <b>Ukupno sa PDV: {{ number_format($final, 0, ',', ' ') }} RSD</b>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        @if (isset($tempOpis))
            <div class="flex flex-col">
                <label for="opis" class="mt-3">Opsta napomena uz ponudu (neobavezan) :</label>
                <textarea class="mt-3 swal-input" id="opis" rows="6" cols="50" type="text" name="opis">{{ $tempOpis }}</textarea>
            </div>
        @else
            <button onclick="showDes()" id="yes-des" class="finish-btn my-3">Dodaj opstu napomenu</button>
            <button onclick="hideDes()" id="nope-des" class="finish-btn my-3"
                style="background-color: #ac1902; display: none;">Necu dodati opstu napomenu</button>
            <div class="flex flex-col" id="text-area" style="display: none;">
                <label for="opis" class="mt-3">Opsta napomena uz ponudu (neobavezan) :</label>
                <textarea class="mt-3 swal-input" id="opis" rows="6" cols="50" type="text" name="opis"></textarea>
            </div>
        @endif
    @endif
    <form method="POST" id="form" action="{{ route('worker.store.new.ponuda') }}">
        @csrf
        <div id="category-dropdown" class="mt-14">
            <span class="input-label pl-2">Odaberi Kategoriju:*</span>
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
            <span class="input-label pl-2">Odaberi Podkategoriju:*</span>
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
        <div id="poz-dropdown" class="category-div">
            <span class="input-label pl-2">Odaberi Poziciju:*</span>
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
                <div class="mt-5 mb-2">
                    <span>Cena pozicija sadrži:*</span>
                </div>
                <p class="py-3">
                    <input type="radio" id="material" name="radioButton" value="1">
                    <label for="material">Cena pozicije sadrži vrednost materiala i usluge</label>
                </p>
                <p class="py-3">
                    <input type="radio" id="service" name="radioButton" value="2">
                    <label for="service">Cena pozicije sadrži vrednost uslugu (bez materiala)</label>
                </p>
                <div id="quantity-text" class="mt-5">
                </div>
                <input type="number" name="quantity" class="quantity-input mt-3 mb-1">
                <div class="mt-5">
                    <span>Cena (RSD)*</span>
                </div>
                <input type="number" name="price" class="quantity-input mt-3 mb-1">
            </div>
        </div>
        <div id="add-new" class="category-div mt-5">
            <div class="flex justify-center mb-5">
                <button type="submit" class="finish-btn my-3">Dodaj poziciju</button>
            </div>
            @if ($mergedData->isNotEmpty())
                <hr>
            @endif
        </div>
    </form>
    @if ($mergedData->isNotEmpty())
        @php
            if(isset($tempNote))
                $finished_note = preg_replace('~^"?(.*?)"?$~', '$1', json_encode($tempNote, JSON_HEX_TAG));
        @endphp
        <div class="flex w-full justify-center mt-5">
            <div class="flex" id="end">
                <button
                    onclick="EndPonuda('{{ $tempPonudaName }}')"
                    class="finish-btn my-3">Zavrsi ponudu</button>
            </div>
        </div>
    @endif
    @if(session('accessDenied'))
        <script>
            Swal.fire({
                title: 'Pristup odbijen',
                text: "{{ session('accessDenied') }}",
                icon: 'error',
                confirmButtonColor: '#d33'
            });
        </script>
    @endif
    <script>
        function showDes() {
            var x = document.getElementById("text-area");
            var y = document.getElementById("nope-des");
            var z = document.getElementById("yes-des");
            if (x.style.display === "none") {
                x.style.display = "flex";
                y.style.display = "flex";
                z.style.display = "none";
            } else {
                x.style.display = "none";
            }
        }

        function hideDes() {
            var x = document.getElementById("nope-des");
            var y = document.getElementById("text-area");
            var z = document.getElementById("yes-des");
            if (x.style.display === "none") {
                x.style.display = "flex";
            } else {
                x.style.display = "none";
                y.style.display = "none";
                z.style.display = "flex";
            }
        }

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

        function actionSwall(url, name, id) {
            Swal.fire({
                title: 'Sigurni ste da hocete da izbrisete "' + name + '"?',
                icon: 'question',
                html: '<form method="POST" id="delElement" action="'+url+'">' +
                    '@csrf' +
                    '@method("delete")' +
                    '<input name="id" hidden value="' + id + '">' +
                    '<button type="submit" class="add-new-btn mx-1 mt-5">Izbrisi</button>' +
                    '</form>',
                showCancelButton: false,
                showConfirmButton: false,
                showCloseButton: true,
            })
        }

        function UpdateSwall(getData) {
            var {
                realId,
                tempDesc,
                tempTitle,
                quantity,
                unit_price,
                radioBtn
            } = getData();
            var radioHtml = '';
            if (radioBtn == 1) {
                radioHtml += '<input type="radio" id="new_material" name="new_radioButton" value="1" checked>' +
                    '<label for="new_material">Cena pozicije sadrži vrednost materiala i usluge</label>' +
                    '<input type="radio" id="new_service" name="new_radioButton" value="2">' +
                    '<label class="mt-2" for="new_service">Cena pozicije sadrži vrednost uslugu (bez materiala)</label>';
            } else if (radioBtn == 2) {
                radioHtml += '<input type="radio" id="new_material" name="new_radioButton" value="1">' +
                    '<label for="new_material">Cena pozicije sadrži vrednost materiala i usluge</label>' +
                    '<input type="radio" id="new_service" name="new_radioButton" value="2" checked>' +
                    '<label class="mt-2" for="new_service">Cena pozicije sadrži vrednost uslugu (bez materiala)</label>';
            }
            Swal.fire({
                title: 'Izmeni poziciju',
                icon: 'question',
                html: '<form method="POST" id="updateDescription" action="{{ route('worker.store.new.update.desc') }}">' +
                    '@csrf' +
                    '@method("put")' +
                    '<span class="font-bold text-black">Ime pozicija :</span>' +
                    '<input name="real_id" hidden value="' + realId + '">' +
                    '<textarea class="mt-3 mb-3 swal-input" rows="2" cols="25" type="text" name="new_title" id="updateTitle">' +
                    tempTitle + '</textarea>' +
                    '<span class="font-bold text-black">Opis pozicije :</span>' +
                    '<textarea class="mt-3 mb-3 swal-input" rows="4" cols="50" type="text" name="new_description" id="updateData">' +
                    tempDesc + '</textarea>' +
                    '<br><p class="mb-3 font-bold text-black">Cena pozicija sadrži:</p>' +
                    radioHtml +
                    '<br><label class="mt-3 mb-2 font-bold text-black" for="new_quantity">Novu kolicinu:</label>' +
                    '<input type="number" name="new_quantity" class="swal-input" id="new_quantity" value="' +
                    quantity + '">' +
                    '<label class="mt-3 mb-2 font-bold text-black" for="new_unit_price">Nova cena:</label>' +
                    '<input type="number" name="new_unit_price" class="swal-input" id="new_unit_price" value="' +
                    unit_price + '">' +
                    '<button type="submit" class="add-new-btn mx-1 mt-5">Izmeni</button>' +
                    '</form>',
                showCancelButton: false,
                showConfirmButton: false,
                showCloseButton: true,
                confirmButtonColor: '#22ff00',
                cancelButtonColor: '#d33',
            })
        }

        function NameSwall(tempPonudaName) {
            let opis = document.getElementById("opis").value;
            Swal.fire({
                title: 'Sacuvaj ponudu',
                icon: 'question',
                html: '<form method="POST" id="formDone" action="{{ route('worker.store.new.ponuda.done') }}">' +
                    '@csrf' +
                    '<label for="ponuda_name">Ime ponude:</label>' +
                    '<input class="mt-3 swal-input" type="text" name="ponuda_name" value="' + tempPonudaName +
                    '"/>' +
                    '<label for="opis" class="mt-3 hidden">Napomena (neobavezan):</label>' +
                    '<textarea class="mt-3 swal-input hidden" rows="4" cols="50" type="text" name="opis">' + opis +
                    '</textarea>' +
                    '<button type="submit" class="add-new-btn my-3">Zavrsi ponudu</button>' +
                    '</form>',
                showCancelButton: false,
                showConfirmButton: false,
                showCloseButton: true,
                confirmButtonColor: '#22ff00',
                cancelButtonColor: '#d33',
            })
        }

        function OpisSwall(tempPonudaName) {
            let opis = document.getElementById("opis").value;
            Swal.fire({
                title: 'Sacuvaj ponudu',
                icon: 'question',
                html: '<form method="POST" id="formDone" action="{{ route('worker.store.new.ponuda.done') }}">' +
                    '@csrf' +
                    '<label for="ponuda_name">Ime ponude:</label>' +
                    '<input class="mt-3 swal-input" type="text" name="ponuda_name" value="' + tempPonudaName +
                    '"/>' +
                    '<label for="opis" class="mt-3 hidden">Napomena (neobavezan):</label>' +
                    '<textarea class="mt-3 swal-input hidden" rows="4" cols="50" type="text" name="opis">' + opis +
                    '</textarea>' +
                    '<label for="note" class="mt-3">Napomena (neobavezan):</label>' +
                    '<textarea class="mt-3 swal-input" rows="4" cols="50" type="text" name="note">' + '{{ $finished_note }}' +
                    '</textarea>' +
                    '<button type="submit" class="add-new-btn my-3">Zavrsi ponudu</button>' +
                    '</form>',
                showCancelButton: false,
                showConfirmButton: false,
                showCloseButton: true,
                confirmButtonColor: '#22ff00',
                cancelButtonColor: '#d33',
            })
        }


        function EndPonuda(tempPonudaName) {
            Swal.fire({
                title: 'Hocete dodati opis?',
                icon: 'question',
                showCancelButton: true,
                showConfirmButton: true,
                showCloseButton: true,
                confirmButtonText: 'Ne',
                cancelButtonText: 'Da',
                confirmButtonColor: '#22ff00',
                cancelButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    NameSwall(tempPonudaName);
                }
                if (result.dismiss == 'cancel') {
                    OpisSwall(tempPonudaName);
                }
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
            sBtn_textSub.innerText = 'Izaberi podkategoriju ';
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
                    span.innerText = "Upisi kolicinu ( " + unitValue + " )*";
                    textDiv.appendChild(span);
                    var span_div = document.getElementById("quantity-input");
                    var inputValue = document.createElement("input");
                    var inputTitle = document.createTextNode(selectedOption);
                    var value = document.createTextNode(selectedValue);
                    inputValue.id = "editTitle";
                    inputValue.name = "edit_title";
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
                    inputValue.name = "edit_title";
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

        function clearUpdateTitle() {
            document.getElementById("updateTitle").value = '';
        }
    </script>
    <style>
        [type="radio"]:checked,
        [type="radio"]:not(:checked) {
            display: none;
        }

        [type="radio"]:checked+label {
            position: relative;
            padding-left: 40px;
            cursor: pointer;
            line-height: 28px;
            display: inline-block;
            color: #000;
        }

        [type="radio"]:not(:checked)+label {
            position: relative;
            padding-left: 40px;
            cursor: pointer;
            line-height: 28px;
            display: inline-block;
            color: #666;
        }

        [type="radio"]:checked+label:before,
        [type="radio"]:not(:checked)+label:before {
            content: "";
            position: absolute;
            left: -1px;
            top: -1px;
            width: 30px;
            height: 30px;
            border: 1px solid #ddd;
            border-radius: 100%;
            background: #fff;
        }

        [type="radio"]:checked+label:after,
        [type="radio"]:not(:checked)+label:after {
            content: "";
            width: 20px;
            height: 20px;
            background: #ed5840;
            position: absolute;
            top: 4px;
            left: 4px;
            border-radius: 100%;
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        [type="radio"]:not(:checked)+label:after {
            opacity: 0;
            -webkit-transform: scale(0);
            transform: scale(0);
        }

        [type="radio"]:checked+label:after {
            opacity: 1;
            -webkit-transform: scale(1);
            transform: scale(1);
        }
    </style>
    </x-app-work-layout>
