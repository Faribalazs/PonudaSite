<x-app-worker-layout>
    <x-slot name="pageTitle">
        Ažuriraj kategoriju
    </x-slot>
    <x-slot name="header">
        Ažuriraj kategoriju
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
        <div class="flex w-full mt-5">
            <form method="POST" id="formCategory" action="{{ route('worker.options.update.category') }}" class="mt-20 flex flex-col w-full">
                @csrf
                <span class="input-label py-3">Upiši naziv kategorije:</span>
                @method('PUT')
                <input type="text" placeholder="Naziv kategorije" value="{{ $category_name }}" name="category" class="w-full dropdown-search">
                <input type="hidden" name="id" value="{{ $id }}" class="w-full dropdown-search">
                <button type="submit" class="main-btn mx-auto mt-10">Sačuvaj</button>
            </form>
        </div>
    </div>
</x-app-work-layout>
