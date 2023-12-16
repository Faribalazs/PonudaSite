<x-app-worker-layout>
    <x-slot name="pageTitle">
        {{ __('app.categories.my-categories') }}
    </x-slot>
    <x-slot name="header">
        {{ __('app.categories.my-categories') }}
    </x-slot>
    @php
        $arrayCategory = [];
        $arraySubcategory = [];
        $arraySubcategoryCounter = [];
        $j = 1;
        $i = 1;
    @endphp

    <div class="category-container">
        <ul id="categoryUl">
            @foreach ($custom_categories as $custom_category)
                @if (!empty($custom_category->id))
                    <li>
                        <div class="flex items-center">
                            @if($custom_category->id >= 500)
                                <a class="mb-1 font-bold hover:underline hover:text-secondary-color" href="{{ route('worker.options.show.category', ['category' => $custom_category->id]) }}">
                                    {{ $custom_category->name }}
                                </a>
                            @else
                                {{ $custom_category->name }}
                            @endif
                            <span class="caret">
                                <i class="ri-arrow-right-s-line text-3xl caret-icon"></i>
                            </span>
                        </div>
                        <ul class="nested">
                            @foreach ($custom_subcategories as $custom_subcategory)
                                @if (!empty($custom_subcategory->id) && ($custom_subcategory->custom_category_id == $custom_category->id || $custom_subcategory->category_id == $custom_category->id))
                                    <li>
                                        <div class="flex items-center">
                                            @if($custom_subcategory->id >= 2000)
                                                <a class="mb-1 hover:underline hover:text-secondary-color" href="{{ route('worker.options.show.subcategory', ['subcategory' => $custom_subcategory->id]) }}">
                                                    {{ $custom_subcategory->name }}
                                                </a>
                                            @else
                                                {{ $custom_subcategory->name }}
                                            @endif
                                            <span class="caret">
                                                <i class="ri-arrow-right-s-line text-3xl caret-icon"></i>
                                            </span>
                                        </div>
                                        <ul class="nested">
                                            @foreach ($custom_pozicije as $custom_pozicija)
                                                @if ($custom_pozicija->custom_subcategory_id == $custom_subcategory->id || $custom_pozicija->subcategory_id == $custom_subcategory->id)
                                                    <li>
                                                        <a class="hover:underline hover:text-secondary-color" href="{{ route('worker.options.show.pozicija', ['pozicija' => $custom_pozicija->id]) }}">
                                                            {{ $custom_pozicija->title ?? $custom_pozicija->custom_title }}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @elseif ($custom_subcategory->custom_category_id == $custom_category->id)
                                    <li>
                                        <a class="hover:underline hover:text-secondary-color" href="{{ route('worker.options.show.subcategory', ['subcategory' => $custom_subcategory->id]) }}">
                                            {{ $custom_subcategory->name }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li>
                        <a class="font-bold hover:underline hover:text-secondary-color" href="{{ route('worker.options.show.category', ['category' => $custom_category->id]) }}">
                            {{ $custom_category->name }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>

    {{-- <div class="grid lg:gap-8 gap-5 mt-24 lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 my-category-grid">
        <div class="w-full flex justify-center flex-col item">
            <span class="text-center pb-5 my-category-title"><b>{{ __('app.categories.my-categories') }}:</b></span>
            <div class="flex flex-col my-category-list-div">
                <div class="flex overflow-y-scroll overflow-x-hidden h-44 flex-col gap-5">
                    @if (!isset($custom_categories[0]))
                    <span class="text-center my-auto text-lg">{{ __('app.categories.no-added-category') }}</span>
                    @endif
                    @foreach ($custom_categories as $custom_category)
                        <div class="flex items-center justify-between pr-3">
                            <div class="my-category-name">
                                <span># {{ array_push($arrayCategory,$custom_category->id) }}&nbsp;</span>
                                <span class="mr-10">{{ $custom_category->name }}</span>
                            </div>
                            <div class="flex">
                                <a class="edit-btn-table mx-2"
                                    href="{{ route('worker.options.show.category', ['category' => $custom_category->id]) }}">
                                    <i class="ri-edit-line"></i>
                                </a>
                                <button class="delete-btn-table"
                                    onclick="actionSwall('{{ route('worker.options.delete.category') }}','{{ $custom_category->id }}')">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="w-full flex justify-center flex-col item">
            <span class="text-center pb-5 my-category-title"><b>{{ __('app.categories.my-subcategories') }}:</b></span>
            <div class="flex flex-col my-category-list-div">
                <div class="flex overflow-y-scroll overflow-x-hidden h-44 flex-col gap-5">
                    @if (!isset($custom_subcategories[0]))
                        <span class="text-center my-auto text-lg">{{ __('app.categories.no-added-subcategory') }}</span>
                    @endif
                    @foreach ($custom_subcategories as $custom_subcategory)
                        @php
                            $id_subcategory = $custom_subcategory->id;
                            if(isset($num_subcategory) && $num_subcategory == array_search($custom_subcategory->custom_category_id, $arrayCategory)+1)
                            {
                                $j++;
                            }
                            else {
                                $num_subcategory = array_search($custom_subcategory->custom_category_id, $arrayCategory)+1;
                                $j = 1;
                            }
                            $arraySubcategory[$id_subcategory] = $num_subcategory;   
                            $arraySubcategoryCounter[$id_subcategory] = $j;
                        @endphp
                        <div class="flex items-center justify-between pr-3">
                            <div>
                                <span># {{ $num_subcategory }}-{{ $j }}</span>
                                <span class="mr-10">{{ $custom_subcategory->name }}</span>
                            </div>
                            <div class="flex">
                                <a class="edit-btn-table mx-2"
                                    href="{{ route('worker.options.show.subcategory', ['subcategory' => $id_subcategory]) }}">
                                    <i class="ri-edit-line"></i>
                                </a>
                                <button class="delete-btn-table"
                                    onclick="actionSwall('{{ route('worker.options.delete.subcategory') }}','{{ $id_subcategory }}')">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="w-full flex justify-center flex-col item">
            <span class="text-center pb-5 my-category-title"><b>{{ __('app.categories.my-pozicija') }}:</b></span>
            <div class="flex flex-col my-category-list-div">
                <div class="flex overflow-y-scroll overflow-x-hidden h-44 flex-col gap-5">
                    @if (!isset($custom_pozicija[0]))
                        <span class="text-center my-auto text-lg">{{ __('app.categories.no-added-pozicija') }}</span>
                    @endif
                    @foreach ($custom_pozicija as $custom_pozicija)
                        <div class="flex items-center justify-between pr-3">
                            <div>
                                @php
                                    if(isset($category_count) && isset($subcategory_count) && isset($arraySubcategory[$custom_pozicija->custom_subcategory_id]) && isset($arraySubcategoryCounter[$custom_pozicija->custom_subcategory_id]) && $category_count == $arraySubcategory[$custom_pozicija->custom_subcategory_id] && $subcategory_count == $arraySubcategoryCounter[$custom_pozicija->custom_subcategory_id])
                                    {
                                            $i++;
                                    }
                                    else {
                                        $i = 1;
                                        $category_count = $arraySubcategory[$custom_pozicija->custom_subcategory_id] ?? 0;
                                        $subcategory_count = $arraySubcategoryCounter[$custom_pozicija->custom_subcategory_id] ?? 0;
                                    }
                                @endphp
                                <span># {{ $category_count }}-{{ $subcategory_count }}-{{ $i }}</span>
                                <span class="mr-10">{{ $custom_pozicija->custom_title }}</span>
                            </div>
                            <div class="flex">
                                <a class="edit-btn-table mx-2"
                                    href="{{ route('worker.options.show.pozicija', ['pozicija' => $custom_pozicija->id]) }}">
                                    <i class="ri-edit-line"></i>
                                </a>
                                <button class="delete-btn-table"
                                    onclick="actionSwall('{{ route('worker.options.delete.pozicija') }}','{{ $custom_pozicija->id }}')">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div> --}}

    <div class="flex items-center flex-col mt-20">
        <div class="mb-10">
            <p class="text-center text-xl font-semibold">
                {{ __('app.categories.choose-option') }}
            </p>
        </div>
        <div>
            <button onclick="addNewOption()" class="main-btn ml-3">
                {{ __('app.categories.dodaj') }}
            </button>
        </div>
    </div>

    <script>
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
                    '<button type="submit" class="add-new-btn mx-1 mt-5">{{ __('app.basic.delete') }}</button>' +
                    '</form>',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = url;
                }
            })
        }
    </script>
    @if ($successMsg == 'kecske' && Auth::guard('worker')->check())
        <script>
            Swal.fire(
                title: '{{ __('app.controllers.deleted-category') }}',
                icon: 'success',
                confirmButtonText: "{{ __('app.basic.close') }}",
                showConfirmButton: false,
                showCloseButton: true,
                confirmButtonColor: '#22ff00',
                cancelButtonColor: '#d33',
            )
        </script>
    @endif
    @if ($successMsg == 'cica' && !empty($name) && Auth::guard('worker')->check())
        <script>
            Swal.fire(
                '{{ __('app.create-ponuda.cica') }}: {{ $name }}',
                '',
                'info'
            )
        </script>
    @endif
    <script>
        function addNewOption() {
            Swal.fire({
                title: '{{ __('app.categories.what-you-want-to-add') }}',
                icon: 'question',
                html: '<div class="flex flex-col gap-5 pb-6">' +
                    '<a href=\"{{ route('worker.options.create.new.category') }}\" class="main-btn">{{ __('app.categories.new-category') }}</a>' +
                    '<a href=\"{{ route('worker.options.create.new.subcategory') }}\" class="main-btn">{{ __('app.categories.new-subcategory') }}</a>' +
                    '<a href=\"{{ route('worker.options.create.new.pozicija') }}\" class="main-btn">{{ __('app.categories.new-pozicija') }}</a>' +
                    '</div>',
                showCancelButton: false,
                showConfirmButton: false,
                showCloseButton: true,
                confirmButtonColor: '#22ff00',
                cancelButtonColor: '#d33',
            })
        }

        var toggler = document.getElementsByClassName("caret");
        var i;

        for (i = 0; i < toggler.length; i++) {
            toggler[i].addEventListener("click", function() {
                this.parentElement.parentElement.querySelector(".nested").classList.toggle("active");
                this.classList.toggle("caret-down");
            });
        }
    </script>

    <style>
        ul,
        #categoryUl {
            list-style-type: none;
        }

        #categoryUl {
            margin: 0;
            padding: 0;
            font-size: 20px;
        }

        #categoryUl li {
            margin-bottom: 8px;
        }

        #categoryUl li:last-child {
            margin-bottom: 0px !important;
        }

        .caret {
            cursor: pointer;
            -webkit-user-select: none;
            /* Safari 3.1+ */
            -moz-user-select: none;
            /* Firefox 2+ */
            -ms-user-select: none;
            /* IE 10+ */
            user-select: none;
        }

        .caret i {
            color: black;
            display: inline-block;
        }

        .caret-down i {
            -ms-transform: rotate(90deg);
            /* IE 9 */
            -webkit-transform: rotate(90deg);
            /* Safari */
            transform: rotate(90deg);
        }

        .nested {
            display: none;
        }

        .nested {
            padding-left: 20px !important;
        }

        .active {
            display: block;
            margin-bottom: 10px;
        }
    </style>
</x-app-worker-layout>
