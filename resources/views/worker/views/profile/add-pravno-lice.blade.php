<x-worker-profile-layout>
    <x-slot name="pageTitle">
        Dodaj pravno lice
    </x-slot>
    <x-slot name="header">
    </x-slot>
    @if(count($errors) > 0)
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Nesto niste dobro uneli'
            })
        </script>
    @endif
    @if(isset($contact))
        <div class="flex profile-title">
            <p class="text-3xl font-bold">Izmeni podatke</p>
        </div>
    @else
        <div class="flex profile-title">
            <p class="text-3xl font-bold">Dodaj pravno lice</p>
        </div>
    @endif

    <div class="flex mt-3 flex-col mb-20">
        <form method="POST" action="{{ route('worker.personal.contacts.add.legal-entity.save') }}" class="flex flex-col"
            enctype="multipart/form-data">
            @csrf
            @if(isset($contact))
                <input type="hidden" name="id" value="{{$contact->id}}"/>
            @endif
            <label for="company_name" class="text-xl my-3">Ime kompanije* :</label>
            <input 
                class="input-style
                {{$errors->has('company_name') ? 'border-error mb-1' : 'mb-3'}}"
                name="company_name"
                value="{{ isset($contact->company_name) ? $contact->company_name : old('company_name') }}"
                type="text"
                maxlength="30"
                required/>
            <p class="{{$errors->has('company_name') ? 'flex text-red mt-1 pl-1' : 'hidden'}}">{{$errors->first('company_name')}}</p>

            <label for="pib" class="text-xl my-3">PIB* :</label>
            <input 
                class="input-style
                {{$errors->has('pib') ? 'border-error mb-1' : 'mb-3'}}"
                name="pib"
                value="{{ isset($contact->pib) ? $contact->pib : old('pib') }}"
                type="text"
                maxlength=""
                required/>
            <p class="{{$errors->has('pib') ? 'flex text-red mt-1 pl-1' : 'hidden'}}">{{$errors->first('pib')}}</p>

            <label for="city" class="text-xl my-3">Grad* :</label>
            <input
                class="input-style
                {{$errors->has('city') ? 'border-error mb-1' : 'mb-3'}}"
                name="city"
                value="{{ isset($contact->city) ? $contact->city : old('city') }}"
                type="text"
                maxlength="30"
                required/>
            <p class="{{$errors->has('city') ? 'flex text-red mt-1 pl-1' : 'hidden'}}">{{$errors->first('city')}}</p>

            <div class="flex lg:flex-row flex-col">
                <div class="flex w-full lg:w-1/2 flex-col lg:pr-2 pl-0">
                    <label for="address" class="text-xl my-3">Adresa* :</label>
                    <input 
                        class="input-style
                        {{$errors->has('address') ? 'border-error mb-1' : 'mb-3'}}"
                        name="address"
                        value="{{ isset($contact->address) ? $contact->address : old('address') }}"
                        type="text"
                        maxlength="50"
                        required/>
                    <p class="{{$errors->has('address') ? 'flex text-red mt-1 pl-1' : 'hidden'}}">{{$errors->first('address')}}</p>
                </div>
                <div class="flex w-full lg:w-1/2 flex-col lg:pl-2 pl-0">
                    <label for="postcode" class="text-xl my-3">Postanski broj* :</label>
                    <input
                        class="input-style
                        {{$errors->has('postcode') ? 'border-error mb-1' : 'mb-3'}}"
                        name="postcode"
                        value="{{ isset($contact->zip_code) ? $contact->zip_code : old('postcode') }}"
                        type="text"
                        maxlength="10"
                        required/>
                    <p class="{{$errors->has('postcode') ? 'flex text-red mt-1 pl-1' : 'hidden'}}">{{$errors->first('postcode')}}</p>
                </div>
            </div>

            <label for="email" class="text-xl my-3">E-mail* :</label>
            <input
                class="input-style
                {{$errors->has('email') ? 'border-error mb-1' : 'mb-3'}}" 
                name="email"
                value="{{ isset($contact->email) ? $contact->email : old('email') }}"
                type="text"
                maxlength="50"
                required/>
            <p class="{{$errors->has('email') ? 'flex text-red mt-1 pl-1' : 'hidden'}}">{{$errors->first('email')}}</p>

            <label for="phone" class="text-xl my-3">Telefon* :</label>
            <input
                class="input-style
                {{$errors->has('phone') ? 'border-error mb-1' : 'mb-3'}}"
                name="phone"
                value="{{ isset($contact->phone) ? $contact->phone : old('phone') }}"
                type="text"
                maxlength="25"
                required/>
            <p class="{{$errors->has('phone') ? 'flex text-red mt-1 pl-1' : 'hidden'}}">{{$errors->first('phone')}}</p>

            @if(isset($contact))
                <button type="submit" class="finish-btn mt-10 text-xl">Promeni podatke</button>
            @else
                <button type="submit" class="finish-btn mt-10 text-xl">Sacuvaj kontakt</button>
            @endif
        </form>
        @if(isset($contact))
        <form method="post" action="{{route('worker.personal.contacts.delete.pravna')}}" class="flex flex-col"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$contact->id}}"/>
            <button type="submit" class="finish-btn mt-16 bg-red text-xl text-center">
                Izbrisi konatakt<i class="ri-delete-bin-line pl-2"></i>
            </button>
        </form>
        @endif
    </div>
</x-worker-profile-layout>
