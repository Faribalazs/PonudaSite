<x-app-worker-layout>
    <x-slot name="pageTitle">
        {{ __('app.categories.catalogue-categories') }}
    </x-slot>
    <x-slot name="header">
        {{ __('app.categories.catalogue-categories') }}
    </x-slot>
    <div class="category-container">
        <ul id="categoryUl">
            @foreach ($custom_categories as $custom_category)
                @if (!empty($custom_category->merged_id))
                    <li>
                        <div class="flex items-center">
                                {{ $custom_category->name }}
                            <span class="caret">
                                <i class="ri-arrow-right-s-line text-3xl caret-icon"></i>
                            </span>
                        </div>
                        <ul class="nested">
                            @foreach ($custom_subcategories as $custom_subcategory)
                                @if (!empty($custom_subcategory->merged_id) && ($custom_subcategory->category_id == $custom_category->id))
                                    <li>
                                        <div class="flex items-center">
                                                {{ $custom_subcategory->name }}
                                            <span class="caret">
                                                <i class="ri-arrow-right-s-line text-3xl caret-icon"></i>
                                            </span>
                                        </div>
                                        <ul class="nested">
                                            @foreach ($custom_pozicije as $custom_pozicija)
                                                @if ($custom_pozicija->subcategory_id == $custom_subcategory->id)
                                                    <li>
                                                        {{ $custom_pozicija->title }}
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @elseif ($custom_subcategory->custom_category_id == $custom_category->id)
                                    <li>
                                        {{ $custom_subcategory->name }}
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li>
                        {{ $custom_category->name }}
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
    <script>
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
