<x-app-layout>
    <x-slot name="pageTitle">
        Update category
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <div class="mt-8">
        @php
            $category_name = '';
            $category_id = '';
        @endphp
        @foreach ($category as $custom_category)
            @php
                $category_name = $custom_category->name;
                $category_id = $custom_category->id;
            @endphp
        @endforeach
        <form method="POST" id="formCategory" action="{{ route('worker.options.update.category') }}">
            @csrf
            <input type="text" placeholder="{{ $category_name }}" value="{{ $category_name }}" name="category" class="w-full dropdown-search mt-4">
            <input type="hidden" name="id" value="{{ $id }}" class="w-full dropdown-search mt-4">

            <button type="submit" class="add-new-btn my-3">Sacuvaj</button>
        </form>
    </div>
    <script>
        document.getElementById("formCategory").addEventListener("submit", function (e) {
            e.preventDefault();
        });
    </script>
</x-app-layout>
