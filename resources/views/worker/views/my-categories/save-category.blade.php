<x-app-worker-layout>
    <x-slot name="pageTitle">
        {{ __('app.categories.update-category') }}
    </x-slot>
    <x-slot name="header">
        {{ __('app.categories.update-category') }}
    </x-slot>
    <div class="mt-8">
        @php
            $category_name = $category->name ?? null;
            $category_id = $category->id ?? null;
        @endphp
        <div class="flex w-full mt-5">
            <form method="POST" id="formCategory" action="{{ route('worker.options.update.category') }}" class="mt-20 flex flex-col w-full">
                @csrf
                <span class="input-label py-3">{{ __('app.categories.write-name-category') }}:</span>
                @method('PUT')
                <input type="text" placeholder="Naziv kategorije" value="{{ $category_name }}" name="category" class="w-full dropdown-search">
                <input type="hidden" name="id" value="{{ $id }}" class="w-full dropdown-search">
                <button type="submit" class="main-btn mx-auto mt-10">{{ __('app.basic.save') }}</button>
            </form>
        </div>
    </div>
</x-app-work-layout>
