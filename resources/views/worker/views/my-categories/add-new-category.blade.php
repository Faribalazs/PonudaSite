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
            <br><br>
            <label for="transliterate">What would you like to do?</label>
            <div id="transliterate">
                <input type="radio" id="transliterate-no" name="transliterate" value="no">
                <label for="transliterate-no">Do not transliterate</label>
                <br>
                <input type="radio" id="transliterate-toCyr" name="transliterate" value="rs-cyrl">
                <label for="transliterate-toCyr">Transliterate to Cyrillic</label>
                <br>
                <input type="radio" id="transliterate-toLat" name="transliterate" value="sr">
                <label for="transliterate-toLat">Transliterate to Latin</label>
                <br>
            </div>            
            <button type="submit" class="main-btn mx-auto mt-10">{{ __('app.basic.save') }}</button>
        </form>
    </div>
</x-app-worker-layout>
