<x-app-layout>
    <x-slot name="pageTitle">
        Update subcategory
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <div class="mt-8">
        @php
            $subcategory_name = '';
            $subcategory_id = '';
        @endphp
        @foreach ($subcategory as $custom_subcategory)
            @php
                $subcategory_name = $custom_subcategory->name;
                $subcategory_id = $custom_subcategory->id;
            @endphp
        @endforeach
    <form method="POST" id="formSubcategory" action="{{ route('worker.options.update.subcategory') }}">
        @csrf
        <input type="text" placeholder="{{ $subcategory_name }}" value="{{ $subcategory_name }}" name="subcategory">
        <input type="hidden" name="id" value="{{ $subcategory_id }}" class="w-full dropdown-search mt-4">
        <button type="submit" class="add-new-btn my-3">Sacuvaj</button>
    </form>
    </div>
</x-app-layout>
