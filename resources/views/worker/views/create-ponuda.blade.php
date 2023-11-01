<x-app-worker-layout>
    <x-slot name="pageTitle">
        @if (isset($swap[0]))
            {{ __('app.create-ponuda.edit-title') }}
        @else
            {{ __('app.create-ponuda.create-title') }}
        @endif
    </x-slot>
    <x-slot name="header">
        @if (isset($swap[0]))
            {{ __('app.create-ponuda.edit-title') }}
        @else
            {{ __('app.create-ponuda.create-title') }}
        @endif
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
                title: 'Uspešno dodato!',
                icon: 'success',
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonText: "{{ __('app.create-ponuda.swal-add-new-pozicija') }}",
                cancelButtonText: "{{ __('app.create-ponuda.swal-finish-ponuda') }}",
                reverseButtons: true,
                allowEscapeKey: false,
                allowOutsideClick: false,
                allowEnterKey: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    setTimeout(scrollDown, 200);
                }
                if (result.isDismissed) {
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
                <table class="table mt-7 text-center ponuda-table">
                    <thead>
                        <tr>
                            <th class="p-2 lowercase" scope="col">
                                {{ __('app.create-ponuda.table-r-br') }}
                            </th>
                            <th class="p-2 lowercase" scope="col">
                                {{ __('app.create-ponuda.table-naziv') }}
                            </th>
                            <th class="p-2 lowercase" scope="col">
                                {{ __('app.create-ponuda.table-j-m') }}
                            </th>
                            <th class="p-2 lowercase" scope="col">
                                {{ __('app.create-ponuda.table-kolicina') }}
                            </th>
                            <th class="p-2 lowercase" scope="col">
                                {{ __('app.create-ponuda.table-jed-cena') }}
                            </th>
                            <th class="p-2 lowercase" scope="col">
                                {{ __('app.create-ponuda.table-ukupno') }}
                            </th>
                            <th class="p-2 lowercase" scope="col">
                                {{ __('app.create-ponuda.table-izmeni') }}
                            </th>
                            <th class="p-2 lowercase" scope="col">
                                {{ __('app.create-ponuda.table-izbrisi') }}
                            </th>
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
                                    <td colspan="8" class="text-left border-bold p-1"
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
                                <td class="text-left ponuda-table-des p-1"><b>
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
                                    <td colspan="8" class="text-right border-bold whitespace-nowrap p-1">
                                        <b>
                                            {{ __('app.create-ponuda.table-svega') }}&nbsp;
                                            <span class="lowercase">{{ $name_category }}</span>:
                                        </b>&nbsp;{{ number_format($subPrice, 0, ',', ' ') }}&nbsp;
                                        {{ __('app.create-ponuda.table-rsd') }}
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
                            <td colspan="8" class="text-left border-bold p-1"
                                style="background-color: rgba(0, 0, 0, 0.05);">
                                <b>
                                    {{ __('app.create-ponuda.table-rekapitulacija') }}
                                </b>
                            </td>
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
                                        <td class="text-left w-full p-1">
                                            {{ $name_category_rekapitulacija }}&nbsp;
                                        </td>
                                        <td class="p-1 text-center whitespace-nowrap">
                                            {{ number_format($subPrice, 0, ',', ' ') }}&nbsp;{{ __('app.create-ponuda.table-rsd') }}
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
                        <td class="text-right p-1">
                            <b>{{ __('app.create-ponuda.table-ukupno') }}: {{ number_format($finalPrice, 0, ',', ' ') }}&nbsp;{{ __('app.create-ponuda.table-rsd') }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right p-1">
                            @php
                                $pdv = intval($finalPrice) * 0.2;
                            @endphp
                            {{ __('app.create-ponuda.table-pdv') }}: {{ number_format($pdv, 0, ',', ' ') }} {{ __('app.create-ponuda.table-rsd') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right p-1">
                            @php
                                $final = $pdv + $finalPrice;
                            @endphp
                            <b>{{ __('app.create-ponuda.table-ukupno-sa-pdv') }}: {{ number_format($final, 0, ',', ' ') }} {{ __('app.create-ponuda.table-rsd') }}</b>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    @endif
    <form method="POST" id="form" action="{{ route('worker.store.new.ponuda') }}">
        @csrf

        @if ($mergedData->isNotEmpty())
            @if (isset($tempOpis))
                <div class="flex flex-col">
                    <label for="opis" class="mt-3">{{ __('app.create-ponuda.opis-label') }}:</label>
                    <textarea class="mt-3 swal-input" id="opis" rows="6" cols="50" type="text" name="opis">{{ $tempOpis }}</textarea>
                </div>
            @else
                <button onclick="showDes()" type="button" id="yes-des" class="finish-btn my-3 {{session('opis_ponude') != '' ? 'hidden' : 'flex'}}">{{ __('app.create-ponuda.opis-btn-add') }}</button>
                <button onclick="hideDes()" type="button" id="nope-des" class="finish-btn my-3 {{session('opis_ponude') != '' ? 'flex' : 'hidden'}}"
                    style="background-color: #ac1902;">{{ __('app.create-ponuda.opis-btn-remove') }}</button>
                <div class="flex-col {{session('opis_ponude') != '' ? 'flex' : 'hidden'}}" id="text-area">
                    <label for="opis" class="mt-3">{{ __('app.create-ponuda.opis-label') }}:</label>
                    <textarea class="mt-3 swal-input" id="opis" rows="6" cols="50" type="text" name="opis">{{ session('opis_ponude') }}</textarea>
                </div>
            @endif
        @endif

        <div id="category-dropdown" class="mt-14">
            <span class="input-label pl-2">{{ __('app.create-ponuda.choose-category') }}:*</span>
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
                        <input type="text" placeholder="{{ __('app.create-ponuda.search') }}..." id="category-search"
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
            <span class="input-label pl-2">{{ __('app.create-ponuda.choose-subcategory') }}:*</span>
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
                        <input type="text" placeholder="{{ __('app.create-ponuda.search') }}..." id="subcategory-filter"
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
            <span class="input-label pl-2">{{ __('app.create-ponuda.choose-pozicija') }}:*</span>
            <div class="select-menu mt-3">
                <div class="select-btn">
                    <span class="sBtn-text">{{ __('app.create-ponuda.choose-pozicija') }}</span>
                    <svg role="img" viewBox="0 0 512 512">
                        <path
                            d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                    </svg>
                </div>
                <ul class="options" id="poz-ul">
                    <li class="option-subcategory">
                        <input type="text" placeholder="{{ __('app.create-ponuda.search') }}..." id="poz-filter" onkeyup="filterFunctionPoz()"
                            class="w-full dropdown-search">
                    </li>
                    @foreach ($custom_pozicija as $poz)
                        <li class="option">
                            <span class="option-text">{{ $poz->custom_title }}</span>
                            <input class="poz-value" hidden value="{{ $poz->custom_description }}">
                            <p class="poz-id">{{ $poz->custom_subcategory_id }}</p>
                            <p class="poz-unit">{{ $poz->unit->name }}</p>
                            <p class="pozicija_id">{{ $poz->id }}</p>
                        </li>
                        <hr>
                    @endforeach
                    @foreach ($pozicija as $poz)
                        <li class="option">
                            <span class="option-text">{{ $poz->title }}</span>
                            <input class="poz-value" hidden value="{{ $poz->description }}">
                            <p class="poz-id">{{ $poz->subcategory_id }}</p>
                            <p class="poz-unit">{{ $poz->unit->name }}</p>
                            <p class="pozicija_id">{{ $poz->id }}</p>
                        </li>
                        <hr>
                    @endforeach
                </ul>
            </div>
            <div id="clear-btn" class="category-div">
                <div class="flex justify-end">
                    <button id="btn" type="button" onclick="clearData()"
                        class="del-btn my-3">
                        {{ __('app.create-ponuda.izbrisi') }}
                    </button>
                </div>
            </div>

            <div class="quantity-div" id="quantity-input">
                <div class="mt-10 mb-2">
                    <span>{{ __('app.create-ponuda.price-with-material-title') }}:*</span>
                </div>
                <p class="py-3">
                    <input type="radio" id="material" name="radioButton" value="1">
                    <label for="material">{{ __('app.create-ponuda.price-with-material') }}</label>
                </p>
                <p class="py-3">
                    <input type="radio" id="service" name="radioButton" value="2">
                    <label for="service">{{ __('app.create-ponuda.price-without-material') }}</label>
                </p>
                <div id="quantity-text" class="mt-10">
                </div>
                <input type="number" name="quantity" class="quantity-input mt-3 mb-1">
                <div class="mt-10">
                    <span>{{ __('app.create-ponuda.price-rsd') }}*</span>
                </div>
                <input type="number" name="price" class="quantity-input mt-3 mb-1">
            </div>
        </div>
        <div id="add-new" class="category-div mt-10">
            <div class="flex justify-center mb-5">
                <button type="submit" class="finish-btn my-3">{{ __('app.create-ponuda.add-pozicija-btn') }}</button>
            </div>
            @if ($mergedData->isNotEmpty())
                <hr>
            @endif
        </div>
    </form>
    @if ($mergedData->isNotEmpty())
        @php
            if (isset($tempNote)) {
                $finished_note = preg_replace('~^"?(.*?)"?$~', '$1', json_encode($tempNote, JSON_HEX_TAG));
            }
        @endphp
        <div class="flex w-full justify-center mt-5">
            <div class="flex" id="end">
                <button onclick="EndPonuda('{{ $tempPonudaName }}')" class="finish-btn my-3">{{ __('app.create-ponuda.finish-ponuda-btn') }}</button>
            </div>
        </div>
    @endif
    @if (session('accessDenied'))
        <script>
            Swal.fire({
                title: "{{ __('app.create-ponuda.swal-access-denied') }}",
                text: "{{ session('accessDenied') }}",
                icon: 'error',
                confirmButtonColor: '#d33'
            });
        </script>
    @endif
    <script>

        function scrollDown() {
            var element = document.querySelector(".select-btn-category");
            element.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }

        function showDes() {
            var x = document.getElementById("text-area");
            var y = document.getElementById("nope-des");
            var z = document.getElementById("yes-des");
            if (x.classList.contains('hidden')) {
                x.classList.remove('hidden');
                x.classList.add('flex');
                y.classList.remove('hidden');
                y.classList.add('flex');
                z.classList.remove('flex');
                z.classList.add('hidden');
            } else {
                x.classList.remove('flex');
                x.classList.add('hidden');
            }
        }

        function hideDes() {
            var x = document.getElementById("nope-des");
            var y = document.getElementById("text-area");
            var z = document.getElementById("yes-des");
            if (x.classList.contains('hidden')) {
                x.classList.remove('hidden');
                x.classList.add('flex');
            } else {
                x.classList.remove('flex');
                x.classList.add('hidden');
                y.classList.remove('flex');
                y.classList.add('hidden');
                z.classList.remove('hidden');
                z.classList.add('flex');
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
                title: "{{ __('app.create-ponuda.swal-are-you-sure-delete') }} " + name + "?",
                icon: 'question',
                html: '<form method="POST" id="delElement" action="' + url + '">' +
                    '@csrf' +
                    '@method('delete')' +
                    '<input name="id" hidden value="' + id + '">' +
                    '<button type="submit" class="add-new-btn-swal2 w-full mx-1 mt-5">{{ __("app.create-ponuda.izbrisi") }}</button>' +
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
                radioHtml += '<div class="flex justify-start flex-col">' +
                    '<input type="radio" id="new_material" name="new_radioButton" value="1" checked>' +
                    '<label for="new_material" class="font-bold text-main-color">{{ __("app.create-ponuda.price-with-material") }}</label>' +
                    '<input type="radio" id="new_service" name="new_radioButton" value="2">' +
                    '<label class="mt-2 font-bold text-main-color" for="new_service">{{ __("app.create-ponuda.price-without-material") }}</label>'+
                    '</div>';
            } else if (radioBtn == 2) {
                radioHtml += '<div class="flex justify-start flex-col">' +
                    '<input type="radio" id="new_material" name="new_radioButton" value="1">' +
                    '<label for="new_material" class="font-bold text-main-color">{{ __("app.create-ponuda.price-with-material") }}</label>' +
                    '<input type="radio" id="new_service" name="new_radioButton" value="2" checked>' +
                    '<label class="mt-2 font-bold text-main-color" for="new_service">{{ __("app.create-ponuda.price-without-material") }}</label>' +
                    '</div>';
            }
            Swal.fire({
                title: '{{ __("app.create-ponuda.swal-change-pozicija") }}',
                icon: 'question',
                html: '<form method="POST" id="updateDescription" action="{{ route('worker.store.new.update.desc') }}">' +
                    '@csrf' +
                    '@method('put')' +
                    '<span class="font-bold text-main-color">{{ __("app.create-ponuda.swal-pozicija-name") }} :</span>' +
                    '<input name="real_id" hidden value="' + realId + '">' +
                    '<textarea class="mt-3 mb-3 swal-input" rows="3" cols="50" type="text" name="new_title" id="updateTitle">' +
                    tempTitle + '</textarea>' +
                    '<span class="font-bold text-main-color">{{ __("app.create-ponuda.swal-pozicija-des") }} :</span>' +
                    '<textarea class="mt-3 mb-3 swal-input" rows="3" cols="50" type="text" name="new_description" id="updateData">' +
                    tempDesc + '</textarea>' +
                    '<br><p class="mb-3 font-bold text-main-color">{{ __("app.create-ponuda.price-with-material-title") }}:</p>' +
                    radioHtml +
                    '<br><label class="mt-3 mb-2 font-bold text-main-color" for="new_quantity">{{ __("app.create-ponuda.table-kolicina") }}:</label>' +
                    '<input type="number" name="new_quantity" class="swal-input mt-3 mb-2" id="new_quantity" value="' +
                    quantity + '">' +
                    '<label class="mt-3 mb-2 font-bold text-main-color" for="new_unit_price">{{ __("app.create-ponuda.price") }}:</label>' +
                    '<input type="number" name="new_unit_price" class="swal-input mt-3 mb-2" id="new_unit_price" value="' +
                    unit_price + '">' +
                    '<button type="submit" class="add-new-btn-swal2 w-full mx-1 mt-5">{{ __("app.create-ponuda.table-izmeni") }}</button>' +
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
                title: '{{ __("app.create-ponuda.swal-save-ponuda") }}',
                icon: 'question',
                html: '<form method="POST" id="formDone" action="{{ route('worker.store.new.ponuda.done') }}">' +
                    '@csrf' +
                    '@if (isset($swap[0]))' +
                    '<input type="hidden" name="edit" value="1"/>' +
                    '@else' +
                    '<input type="hidden" name="edit" value="0"/>' +
                    '@endif' +
                    '<label for="ponuda_name" class="font-bold text-main-color">{{ __("app.create-ponuda.swal-ponuda-name") }}:</label>' +
                    '<input class="mt-3 swal-input mb-3" type="text" name="ponuda_name" value="' + tempPonudaName +
                    '"/>' +
                    '<label for="opis" class="mt-3 hidden">{{ __("app.create-ponuda.swal-ponuda-napomena") }}:</label>' +
                    '<textarea class="mt-3 swal-input hidden" rows="4" cols="50" type="text" name="opis">' + opis +
                    '</textarea>' +
                    '<button type="submit" class="add-new-btn-swal2 w-full my-3">{{ __("app.create-ponuda.finish-ponuda-btn") }}</button>' +
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
                title: '{{ __("app.create-ponuda.swal-save-ponuda") }}',
                icon: 'question',
                html: '<form method="POST" id="formDone" action="{{ route('worker.store.new.ponuda.done') }}">' +
                    '@csrf' +
                    '@if (isset($swap[0]))' +
                    '<input type="hidden" name="edit" value="1"/>' +
                    '@else' +
                    '<input type="hidden" name="edit" value="0"/>' +
                    '@endif' +
                    '<label for="ponuda_name" class="font-bold text-main-color">{{ __("app.create-ponuda.swal-ponuda-name") }}:</label>' +
                    '<input class="mt-3 mb-3 swal-input" type="text" name="ponuda_name" value="' + tempPonudaName +
                    '"/>' +
                    '<label for="opis" class="mt-3 hidden">{{ __("app.create-ponuda.swal-ponuda-napomena") }}:</label>' +
                    '<textarea class="mt-3 swal-input hidden" rows="4" cols="50" type="text" name="opis">' + opis +
                    '</textarea>' +
                    '<label for="note" class="mt-3 font-bold text-main-color">{{ __("app.create-ponuda.swal-ponuda-napomena") }}:</label>' +
                    '<textarea class="mt-3 swal-input mb-3" rows="4" cols="50" type="text" name="note">' +
                    '{{ $finished_note }}' +
                    '</textarea>' +
                    '<button type="submit" class="add-new-btn-swal2 w-full my-3">{{ __("app.create-ponuda.finish-ponuda-btn") }}</button>' +
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
                title: '{{ __("app.create-ponuda.swal-add-opis") }}' + '?',
                icon: 'question',
                showCancelButton: true,
                showConfirmButton: true,
                showCloseButton: true,
                confirmButtonText: '{{ __("app.create-ponuda.swal-yes") }}',
                cancelButtonText: '{{ __("app.create-ponuda.swal-no") }}',
            }).then((result) => {
                if (result.isConfirmed) {
                    OpisSwall(tempPonudaName);
                }
                if (result.dismiss == 'cancel') {
                    NameSwall(tempPonudaName);
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
            sBtn_textSub.innerText = "{{ __('app.create-ponuda.choose-subcategory') }}";
            sBtn_text.innerText = "{{ __('app.create-ponuda.choose-pozicija') }}";
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
            sBtn_text.innerText = "{{ __('app.create-ponuda.choose-pozicija') }}";
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
                    span.innerText = "Upiši kolicinu ( " + unitValue + " )*";
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
                    span.innerText = "Upiši kolicinu ( " + unitValue + " )";
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
            background: #0d2c5a;
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
