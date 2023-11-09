<x-app-worker-layout>
    <x-slot name="pageTitle">
        {{ __('app.categories.update-subcategory') }}    
    </x-slot>
    <x-slot name="header">
        {{ __('app.categories.update-subcategory') }}    
    </x-slot>
    <div class="mt-8">
        @php
            $subcategory_name = $subcategory->name ?? null;
            $subcategory_id = $subcategory->id ?? null;
        @endphp
        <div class="flex w-full mt-5">
            <form method="POST" id="formSubcategory" action="{{ route('worker.options.update.subcategory') }}" class="mt-20 flex flex-col w-full">
                @csrf
                <span class="input-label py-3">{{ __('app.categories.write-name-subcategory') }}:</span>
                @method('PUT')
                <input type="text" placeholder="{{ $subcategory_name }}" value="{{ $subcategory_name }}" name="subcategory">
                <input type="hidden" name="id" value="{{ $subcategory_id }}" class="w-full dropdown-search mt-4">
                <button type="submit" class="main-btn mx-auto mt-10">{{ __('app.basic.save') }}</button>
            </form>
        </div>
    </div>
</x-app-worker-layout>
