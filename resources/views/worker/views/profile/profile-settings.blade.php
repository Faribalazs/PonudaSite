<x-worker-profile-layout>
    <x-slot name="pageTitle">
        Profil
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <div class="flex profile-title">
        <p class="text-3xl font-bold">Podesavanja :</p>
    </div>
    <div class="flex mt-3 flex-col">
        <p class="text-2xl font-bold mt-5">Promeni lozinku :</p>
        <form>
            <div class="flex flex-col">
                <label for="old_password" class="sm:text-xl text-base my-3">Stara lozinka :</label>
                <input class="input-style {{ $errors->has('old_password') ? 'border-error mb-1' : 'mb-3' }}"
                    name="old_password" value="{{ old('old_password') }}" maxlength="30" type="text" required />
                <p class="{{ $errors->has('old_password') ? 'flex text-red mt-1 pl-1' : 'hidden' }}">
                    {{ $errors->first('old_password') }}</p>
            </div>
        </form>
    </div>
</x-worker-profile-layout>
