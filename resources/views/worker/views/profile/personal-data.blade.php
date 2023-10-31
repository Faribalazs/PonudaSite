<x-worker-profile-layout>
    <x-slot name="pageTitle">
        Podaci firme
    </x-slot>
    <x-slot name="header">
    </x-slot>
    @php
        $user_id = Auth::guard('worker')->user()->id;
    @endphp
    <div class="flex profile-title">
        <p class="{{ Auth::guard('worker')->user()->hasRole('super_worker')? '': 'mb-4' }} text-3xl font-bold">Podaci
            firme</p>
    </div>
    @if (Auth::guard('worker')->user()->hasRole('super_worker') && !empty($company_data))
        <div class="mt-3">
            <form method="POST" action="{{ route('worker.personal.company.delete') }}">

                @csrf

                @method('DELETE')

                <button type="submit" class="finish-btn">
                    Izbriši
                </button>
            </form>
        </div>
    @endif
    @if (count($errors) > 0)
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Nešto niste dobro uneli'
            })
        </script>
    @endif
    @if (!empty($company_data))
        <div class="flex mt-3 flex-col">
            <div class="flex gap-1 flex-wrap mb-3">
                <p class="sm:text-xl text-base font-bold">Naziv kompanije :</p>
                <p class="sm:text-xl text-base">{{ $company_data->company_name }}</p>
            </div>
            <div class="flex gap-1 flex-wrap mb-3">
                <p class="sm:text-xl text-base font-bold">Država :</p>
                <p class="sm:text-xl text-base">{{ $company_data->country }}</p>
            </div>
            <div class="flex gap-1 flex-wrap mb-3">
                <p class="sm:text-xl text-base font-bold">Grad :</p>
                <p class="sm:text-xl text-base">{{ $company_data->city }}</p>
            </div>
            <div class="flex gap-1 flex-wrap mb-3">
                <p class="sm:text-xl text-base font-bold">Poštanski broj :</p>
                <p class="sm:text-xl text-base">{{ $company_data->zip_code }}</p>
            </div>
            <div class="flex gap-1 flex-wrap mb-3">
                <p class="sm:text-xl text-base font-bold">Adresa :</p>
                <p class="sm:text-xl text-base">{{ $company_data->address }}</p>
            </div>
            <div class="flex gap-1 flex-wrap mb-3">
                <p class="sm:text-xl text-base font-bold">Broj telefona :</p>
                <p class="sm:text-xl text-base">{{ $company_data->phone }}</p>
            </div>
            <div class="flex gap-1 flex-wrap mb-3">
                <p class="sm:text-xl text-base font-bold">PIB :</p>
                <p class="sm:text-xl text-base">{{ $company_data->pib }}</p>
            </div>
            <div class="flex gap-1 flex-wrap mb-3">
                <p class="sm:text-xl text-base font-bold">Matični broj :</p>
                <p class="sm:text-xl text-base">{{ $company_data->maticni_broj }}</p>
            </div>
            <div class="flex gap-1 flex-wrap mb-3">
                <p class="sm:text-xl text-base font-bold">Tekući račun :</p>
                <p class="sm:text-xl text-base">{{ $company_data->tekuci_racun }}</p>
            </div>
            <div class="flex gap-1 flex-wrap mb-3">
                <p class="sm:text-xl text-base font-bold">Bank account :</p>
                <p class="sm:text-xl text-base">{{ $company_data->bank_account }}</p>
            </div>
            <div class="flex gap-1 flex-wrap mb-3">
                <p class="sm:text-xl text-base font-bold">Naziv banke :</p>
                <p class="sm:text-xl text-base">{{ $company_data->bank_name }}</p>
            </div>
            <div class="flex gap-1 flex-col mb-3">
                <p class="sm:text-xl text-base font-bold mb-1">Logo firme :</p>
                <img src="{{ url('storage/' . $company_data->logo) }}" alt="{{ $company_data->company_name }}"
                    style="width:500px; height: 240px; object-fit: cover;">
            </div>
        </div>
    @else
        <div class="flex mt-3 flex-col">
            <form method="POST" action="{{ route('worker.personal.data.save') }}" class="flex flex-col"
                enctype="multipart/form-data">

                @csrf

                <label for="company_name" class="sm:text-xl text-base my-3">Tačan naziv firme* :</label>
                <input class="input-style {{ $errors->has('company_name') ? 'border-error mb-1' : 'mb-3' }}"
                    name="company_name" value="{{ old('company_name') }}" maxlength="50" type="text" required />
                <p class="{{ $errors->has('company_name') ? 'flex text-red mt-1 pl-1' : 'hidden' }}">
                    {{ $errors->first('company_name') }}</p>

                <label for="country" class="sm:text-xl text-base my-3">Država* :</label>
                <input class="input-style {{ $errors->has('country') ? 'border-error mb-1' : 'mb-3' }}" name="country"
                    value="{{ old('country') }}" maxlength="20" type="text" required />
                <p class="{{ $errors->has('country') ? 'flex text-red mt-1 pl-1' : 'hidden' }}">
                    {{ $errors->first('country') }}</p>

                <div class="flex lg:flex-row flex-col">
                    <div class="flex w-full lg:w-1/2 flex-col lg:pr-2 pr-0">
                        <label for="city" class="sm:text-xl text-base my-3">Grad* :</label>
                        <input class="input-style {{ $errors->has('city') ? 'border-error mb-1' : 'mb-3' }}"
                            name="city" value="{{ old('city') }}" maxlength="30" type="text" required />
                        <p class="{{ $errors->has('city') ? 'flex text-red mt-1 pl-1' : 'hidden' }}">
                            {{ $errors->first('city') }}</p>
                    </div>
                    <div class="flex w-full lg:w-1/2 flex-col lg:pl-2 pl-0">
                        <label for="postcode" class="sm:text-xl text-base my-3">Poštanski broj* :</label>
                        <input class="input-style {{ $errors->has('postcode') ? 'border-error mb-1' : 'mb-3' }}"
                            name="postcode" value="{{ old('postcode') }}" maxlength="10" type="text" required />
                        <p class="{{ $errors->has('postcode') ? 'flex text-red mt-1 pl-1' : 'hidden' }}">
                            {{ $errors->first('postcode') }}</p>
                    </div>
                </div>
                <label for="address" class="sm:text-xl text-base my-3">Adresa* :</label>
                <input class="input-style {{ $errors->has('address') ? 'border-error mb-1' : 'mb-3' }}" name="address"
                    value="{{ old('address') }}" maxlength="50" type="text" required />
                <p class="{{ $errors->has('address') ? 'flex text-red mt-1 pl-1' : 'hidden' }}">
                    {{ $errors->first('address') }}</p>

                <label for="email" class="sm:text-xl text-base my-3">E-mail* :</label>
                <input class="input-style {{ $errors->has('email') ? 'border-error mb-1' : 'mb-3' }}" name="email"
                    value="{{ old('email') }}" maxlength="40" type="text" required />
                <p class="{{ $errors->has('email') ? 'flex text-red mt-1 pl-1' : 'hidden' }}">
                    {{ $errors->first('email') }}</p>

                <label for="phone" class="sm:text-xl text-base my-3">Telefon* :</label>
                <input class="input-style {{ $errors->has('phone') ? 'border-error mb-1' : 'mb-3' }}" name="phone"
                    value="{{ old('phone') }}" maxlength="25" type="text" required />
                <p class="{{ $errors->has('phone') ? 'flex text-red mt-1 pl-1' : 'hidden' }}">
                    {{ $errors->first('phone') }}</p>

                <div class="flex lg:flex-row flex-col">
                    <div class="flex w-full lg:w-1/2 flex-col lg:pr-2 pr-0">
                        <label for="pib" class="sm:text-xl text-base my-3">PIB* :</label>
                        <input class="input-style {{ $errors->has('pib') ? 'border-error mb-1' : 'mb-3' }}"
                            name="pib" value="{{ old('pib') }}" maxlength="20" type="text" required />
                        <p class="{{ $errors->has('pib') ? 'flex text-red mt-1 pl-1' : 'hidden' }}">
                            {{ $errors->first('pib') }}</p>
                    </div>
                    <div class="flex w-full lg:w-1/2 flex-col lg:pl-2 pl-0">
                        <label for="maticni_broj" class="sm:text-xl text-base my-3">Matični broj* :</label>
                        <input class="input-style {{ $errors->has('maticni_broj') ? 'border-error mb-1' : 'mb-3' }}"
                            name="maticni_broj" value="{{ old('maticni_broj') }}" maxlength="25" type="text"
                            required />
                        <p class="{{ $errors->has('maticni_broj') ? 'flex text-red mt-1 pl-1' : 'hidden' }}">
                            {{ $errors->first('maticni_broj') }}</p>
                    </div>
                </div>

                <label for="tekuci_racun" class="sm:text-xl text-base my-3">Tekući račun* :</label>
                <input class="input-style {{ $errors->has('tekuci_racun') ? 'border-error mb-1' : 'mb-3' }}"
                    name="tekuci_racun" value="{{ old('tekuci_racun') }}" maxlength="30" type="text" required />
                <p class="{{ $errors->has('tekuci_racun') ? 'flex text-red mt-1 pl-1' : 'hidden' }}">
                    {{ $errors->first('tekuci_racun') }}</p>

                <label for="bank_name" class="sm:text-xl text-base my-3">Naziv banke* :</label>
                <input class="input-style {{ $errors->has('bank_name') ? 'border-error mb-1' : 'mb-3' }}"
                    name="bank_name" value="{{ old('bank_name') }}" maxlength="30" type="text" required />
                <p class="{{ $errors->has('bank_name') ? 'flex text-red mt-1 pl-1' : 'hidden' }}">
                    {{ $errors->first('bank_name') }}</p>

                <label for="bank_account" class="sm:text-xl text-base my-3">Bank account :</label>
                <input class="input-style {{ $errors->has('bank_account') ? 'border-error mb-1' : 'mb-3' }}"
                    name="bank_account" value="{{ old('bank_account') }}" maxlength="30" type="text" />
                <p class="{{ $errors->has('bank_account') ? 'flex text-red mt-1 pl-1' : 'hidden' }}">
                    {{ $errors->first('bank_account') }}</p>

                <label class="text-xl my-3">
                    Logo firme* :
                </label>
                <div class="flex flex-col sm:flex-row">
                    <label for="file-upload" class="image-upload-btn px-4 py-3 text-center">
                        Izaberi sliku
                    </label>
                    <input id="file-upload" name="logo" type="file" style="display:none;">
                    <input id="uploadFile" class="text-center sm:text-left sm:pl-3 pl-0 sm:mt-0 mt-2 max-w-full"
                        placeholder="Niste izabrali sliku" disabled="disabled" />
                </div>
                <p class="{{ $errors->has('logo') ? 'flex text-red mt-2 pl-1' : 'hidden' }}">
                    {{ $errors->first('logo') }}</p>
                <button type="submit" class="finish-btn sm:mt-20 mt-12 mb-20 text-xl">Sačuvaj podatke</button>
            </form>
        </div>
        <script>
            document.getElementById("file-upload").onchange = function() {
                document.getElementById("uploadFile").value = this.value.replace('C:\\fakepath\\', ' ');
            };
        </script>
    @endif
</x-worker-profile-layout>
