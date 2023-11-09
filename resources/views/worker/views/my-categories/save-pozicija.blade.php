<x-app-worker-layout>
    <x-slot name="pageTitle">
        {{ __('app.categories.update-position') }}
    </x-slot>
    <x-slot name="header">
        {{ __('app.categories.update-position') }}
    </x-slot>
    <div class="mt-8">
        @php
            $pozicija_title = $pozicija->custom_title ?? null;
            $pozicija_desc = $pozicija->custom_description ?? null;
            $pozicija_id = $pozicija->id ?? null;
        @endphp
        <div class="flex w-full mt-5">
            <form method="POST" id="formPozicija" action="{{ route('worker.options.update.pozicija') }}"
                class="mt-20 flex flex-col w-full">
                @csrf
                <span class="input-label py-3">{{ __('app.categories.write-name-position') }}:</span>
                @method('PUT')
                <input type="text" placeholder="{{ $pozicija_title }}" value="{{ $pozicija_title }}" name="title"
                    class="w-full dropdown-search">
                <span class="input-label py-3 mt-5">{{ __('app.categories.description-position') }}:</span>
                <textarea type="text" rows="5" value="{{ $pozicija_desc }}" name="description"
                    class="w-full dropdown-search">{{ $pozicija_desc }}</textarea>
                <label for="unit">{{ __('app.categories.calculation') }}:</label>
                <select name="unit" class="mt-3 form-control">
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id_unit }}" {{ $unit->id_unit == $pozicija->unit_id ? 'selected' : '' }}>{{ $unit->name }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="id" value="{{ $pozicija_id }}" class="w-full dropdown-search mt-4">
                <button type="submit" class="main-btn mx-auto mt-10">{{ __('app.basic.save') }}</button>
            </form>
        </div>
    </div>
    </x-app-layout>
