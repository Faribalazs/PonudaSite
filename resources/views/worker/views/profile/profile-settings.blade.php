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
        <form action="{{ route('worker.personal.account.settings.update-password') }}" method="POST">
            @csrf
            <div class="flex flex-col">
                <label for="old_password" class="sm:text-xl text-base my-3">Stara lozinka :</label>
                <input class="input-style {{ $errors->has('old_password') ? 'border-error mb-1' : 'mb-3' }}"
                    name="old_password" type="password" placeholder="Stara lozinka" required>
                <p class="{{ $errors->has('old_password') ? 'flex text-red mt-1 pl-1' : 'hidden' }}">
                    {{ $errors->first('old_password') }}</p>
            </div>
            <div class="flex flex-col">
                <label for="newPasswordInput" class="sm:text-xl text-base my-3">Nova lozinka :</label>
                <input name="new_password" type="password" class="input-style {{ $errors->has('new_password') ? 'border-error mb-1' : 'mb-3' }}" id="newPasswordInput"
                    placeholder="Nova lozinka" required>
                <p class="{{ $errors->has('new_password') ? 'flex text-red mt-1 pl-1' : 'hidden' }}">
                    {{ $errors->first('new_password') }}</p>
            </div>
            <div class="flex flex-col">
                <label for="confirmNewPasswordInput" class="sm:text-xl text-base my-3">Potvrdite novu lozinku :</label>
                <input name="new_password_confirmation" type="password" class="input-style" id="confirmNewPasswordInput"
                    placeholder="Potvrdite novu lozinku" required>
            </div>
            <button class="add-new-contact-btn flex rounded-md justify-center mt-10 w-2/4 py-2 mx-auto" type="submit">Promeni</button>
        </form>
    </div>
</x-worker-profile-layout>
