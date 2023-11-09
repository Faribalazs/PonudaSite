<x-app-worker-layout>
    <x-slot name="pageTitle">
        {{ __('app.categories.new-category') }}
    </x-slot>
    <x-slot name="header">
        {{ __('app.categories.new-category') }}
    </x-slot>
    <div class="flex w-full mt-5">
        <form method="POST" id="add_new_category" class="mt-20 flex flex-col w-full"
            action="{{ route('worker.options.store.new.category') }}">
            @csrf
            <span class="input-label py-2">{{ __('app.categories.write-name-category') }}:</span>
            <input type="text" name="category_name" class="input-style">
            <button type="submit" class="main-btn mx-auto mt-10">{{ __('app.basic.save') }}</button>
        </form>
    </div>
</x-app-worker-layout>
