<x-app-layout>
    <x-slot name="pageTitle">
        Nova Kategorija
    </x-slot>
    <x-slot name="header">
    </x-slot>
    @php
        $user_id = Auth::guard('worker')->user()->id;
    @endphp
    <div class="flex w-full mt-5">
        <form method="POST" id="add_new_category" class="mt-20 flex flex-col w-full"
            action="{{ route('worker.store.new.category') }}">
            @csrf
            <span class="input-label py-2">Upisi naziv kategorije:</span>
            <input type="text" name="category_name" class="input-style mb-10">
            <button type="submit" class="submit-btn m-auto">Dodaj kategoriju</button>
        </form>
    </div>
</x-app-layout>
