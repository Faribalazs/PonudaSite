<x-worker-profile-layout>
    <x-slot name="pageTitle">
        Dodaj fizicko lice
    </x-slot>
    <x-slot name="header">
    </x-slot>
    @php
        $user_id = Auth::guard('worker')->user()->id;
    @endphp
    <div class="flex profile-title">
        <p class="text-3xl font-bold">Dodaj fizicko lice</p>
    </div>

    <div class="flex mt-3 flex-col">
        <form method="POST" action="{{ route('worker.personal.contacts.add.individual.save') }}" class="flex flex-col"
            enctype="multipart/form-data">

            @csrf
            <input type="hidden" name="worker_id" value="{{ $user_id }}" />
            <div class="flex flex-lg-row flex-col">
                <div class="flex w-full w-lg-1/2 flex-col pr-2">
                    <label for="f_name" class="text-xl my-3">Ime* :</label>
                    <input class="input-style mb-3" name="f_name" type="text" />
                </div>
                <div class="flex w-full w-lg-1/2 flex-col pl-2">
                    <label for="l_name" class="text-xl my-3">Prezime* :</label>
                    <input class="input-style mb-3" name="l_name" type="text" />
                </div>
            </div>

            <label for="gard" class="text-xl my-3">Grad* :</label>
            <input class="input-style mb-3" name="grad" type="text" />

            <div class="flex flex-lg-row flex-col">
                <div class="flex w-full w-lg-1/2 flex-col pr-2">
                    <label for="adresa" class="text-xl my-3">Adresa* :</label>
                    <input class="input-style mb-3" name="adresa" type="text" />
                </div>
                <div class="flex w-full w-lg-1/2 flex-col pl-2">
                    <label for="postcode" class="text-xl my-3">Postanski broj* :</label>
                    <input class="input-style mb-3" name="postcode" type="number" />
                </div>
            </div>

            <label for="email" class="text-xl my-3">E-mail* :</label>
            <input class="input-style mb-3" name="email" type="text" />

            <label for="tel" class="text-xl my-3">Telefon* :</label>
            <input class="input-style mb-3" name="tel" type="number" />

            <button type="submit" class="finish-btn mt-5 text-xl">Sacuvaj kontakt</button>
        </form>
    </div>
</x-worker-profile-layout>
