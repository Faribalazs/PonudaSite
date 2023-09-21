<x-worker-profile-layout>
    <x-slot name="pageTitle">
        Profil
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <div class="flex profile-title">
        <p class="text-3xl font-bold">Moj nalog</p>
    </div>
    <div class="flex mt-3 flex-col">
        <div class="mt-3">
            <p class="text-xl"><b>Ime i prezime :</b> {{ Auth::user()->name }}</p>
        </div>
        <div class="mt-3">
            <p class="text-xl"><b>E-mail :</b> {{ Auth::user()->email }}</p>
        </div>
        <form action="{{ route('worker.myprofile.send.email') }}" method="POST">
            @csrf
            @method('put')
            <fieldset>
                <legend>Posalji meni imejl kad skinem pdf:</legend>
                
                <div>
                    <input type="radio" id="skini_no" name="skini" value="1" @if (!auth('worker')->user()->send_email_on_download) {{ 'checked' }} @endif />
                    <label for="skini_no">Ne</label>
                </div>
                
                <div>
                    <input type="radio" id="skini_yes" name="skini" value="2" @if (auth('worker')->user()->send_email_on_download) {{ 'checked' }} @endif />
                    <label for="skini_yes">Da</label>
                </div>
            </fieldset>

            <fieldset>
                <legend>Posalji meni imejl kad posaljem pdf:</legend>
                
                <div>
                    <input type="radio" id="posalji_no" name="posalji" value="1" @if (!auth('worker')->user()->send_email_on_send) {{ 'checked' }} @endif />
                    <label for="posalji_no">Ne</label>
                </div>
                
                <div>
                    <input type="radio" id="posalji_yes" name="posalji" value="2" @if (auth('worker')->user()->send_email_on_send) {{ 'checked' }} @endif />
                    <label for="posalji_yes">Da</label>
                </div>
            </fieldset>
            
            <button class="add-new-contact-btn flex rounded-md justify-center mt-10 w-2/4 py-2 mx-auto" type="submit">Promeni</button>
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
            background: #ed5840;
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
