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
                <input name="new_password" type="password"
                    class="input-style {{ $errors->has('new_password') ? 'border-error mb-1' : 'mb-3' }}"
                    id="newPasswordInput" placeholder="Nova lozinka" required>
                <p class="{{ $errors->has('new_password') ? 'flex text-red mt-1 pl-1' : 'hidden' }}">
                    {{ $errors->first('new_password') }}</p>
            </div>
            <div class="flex flex-col">
                <label for="confirmNewPasswordInput" class="sm:text-xl text-base my-3">Potvrdite novu lozinku :</label>
                <input name="new_password_confirmation" type="password" class="input-style" id="confirmNewPasswordInput"
                    placeholder="Potvrdite novu lozinku" required>
            </div>
            <button class="add-new-contact-btn flex rounded-md text-xl justify-center mt-10 w-2/4 py-2 mx-auto"
                type="submit">Promeni</button>
        </form>
    </div>

    <div class="flex mt-10 flex-col mb-20">
        <p class="text-2xl font-bold mt-5 mb-5">E-mail poruke :</p>
        <form action="{{ route('worker.myprofile.send.email') }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label class="sm:text-xl text-base my-3">Pošalji ponudu na moj E-mail nakon skidanja PDF dokumenta:</label>
                <div class="flex mt-5">
                    <div class="mr-20">
                        <input type="radio" id="skini_no" name="skini" value="1"
                            @if (!auth('worker')->user()->send_email_on_download) {{ 'checked' }} @endif />
                        <label for="skini_no">Ne</label>
                    </div>
                    <div>
                        <input type="radio" id="skini_yes" name="skini" value="2"
                            @if (auth('worker')->user()->send_email_on_download) {{ 'checked' }} @endif />
                        <label for="skini_yes">Da</label>
                    </div>
                </div>
            </div>

            <div class="mt-10">
                <label class="sm:text-xl text-base my-3">Pošalji ponudu na moj E-mail nakon slanja PDF dokumenta klijentu:</label>
                <div class="flex mt-5">
                    <div class="mr-20">
                        <input type="radio" id="posalji_no" name="posalji" value="1"
                            @if (!auth('worker')->user()->send_email_on_send) {{ 'checked' }} @endif />
                        <label for="posalji_no">Ne</label>
                    </div>
                    <div>
                        <input type="radio" id="posalji_yes" name="posalji" value="2"
                            @if (auth('worker')->user()->send_email_on_send) {{ 'checked' }} @endif />
                        <label for="posalji_yes">Da</label>
                    </div>
                </div>
            </div>
            <button class="add-new-contact-btn flex rounded-md text-xl justify-center mt-10 w-2/4 py-2 mx-auto"
                type="submit">Promeni</button>
        </form>
    </div>

    <style>
        [type="radio"]:checked,
        [type="radio"]:not(:checked) {
            display: none;
        }

        [type="radio"]:checked+label {
            position: relative;
            padding-left: 40px;
            cursor: pointer;
            line-height: 28px;
            display: inline-block;
            color: #000;
        }

        [type="radio"]:not(:checked)+label {
            position: relative;
            padding-left: 40px;
            cursor: pointer;
            line-height: 28px;
            display: inline-block;
            color: #666;
        }

        [type="radio"]:checked+label:before,
        [type="radio"]:not(:checked)+label:before {
            content: "";
            position: absolute;
            left: -1px;
            top: -1px;
            width: 30px;
            height: 30px;
            border: 1px solid #ddd;
            border-radius: 100%;
            background: #fff;
        }

        [type="radio"]:checked+label:after,
        [type="radio"]:not(:checked)+label:after {
            content: "";
            width: 20px;
            height: 20px;
            background: #0d2c5a;
            position: absolute;
            top: 4px;
            left: 4px;
            border-radius: 100%;
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        [type="radio"]:not(:checked)+label:after {
            opacity: 0;
            -webkit-transform: scale(0);
            transform: scale(0);
        }

        [type="radio"]:checked+label:after {
            opacity: 1;
            -webkit-transform: scale(1);
            transform: scale(1);
        }
    </style>
</x-worker-profile-layout>
