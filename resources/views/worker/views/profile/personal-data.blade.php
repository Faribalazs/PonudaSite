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
        <p class="text-3xl font-bold">Podaci firme</p>
    </div>
    @if(Auth::guard('worker')->user()->hasRole('super_worker'))
        <div class="mt-3">
            <form method="POST" action="{{ route('worker.personal.company.delete') }}" enctype="multipart/form-data">
            @csrf
            @method('delete')
            <button type="submit" class="finish-btn">
                Izbrisi
            </button>
            </form>
        </div>
    @endif
    @if (!empty($company_data))
    <div class="flex mt-3 flex-col">
        <p>Company name: {{ $company_data->company_name }}</p>
        <p>Country: {{ $company_data->country }}</p>
        <p>City: {{ $company_data->city }}</p>
        <p>Zip code: {{ $company_data->zip_code }}</p>
        <p>Address: {{ $company_data->address }}</p>
        <p>Telefon: {{ $company_data->tel }}</p>
        <p>PIB: {{ $company_data->pib }}</p>
        <p>Maticni broj: {{ $company_data->maticni_broj }}</p>
        <p>Tekuci racun: {{ $company_data->tekuci_racun }}</p>
        <p>Bank account: {{ $company_data->bank_account }}</p>
        <p>Bank name: {{ $company_data->bank_name }}</p>
        <img src="{{ url('storage/worker/'. $user_id .'/logo'. '/' . $company_data->logo) }}" alt="{{ $company_data->company_name }}" style="width:500px; height: 240px; object-fit: cover;">
    </div>
    @else
    <div class="flex mt-3 flex-col">
        {{-- Kell majd egy if ha van hozzaadva akkor kijon a szoveg ha nincs akkor a form --}}
            <form method="POST" action="{{ route('worker.personal.data.save') }}" class="flex flex-col" enctype="multipart/form-data">
           
            @csrf

            <label for="naziv_firme" class="text-xl my-3">Tacan naziv firme* :</label>
            <input class="input-style mb-3" name="naziv_firme" type="text"/>
            <label for="drzava" class="text-xl my-3">Drzava* :</label>
            <input class="input-style mb-3" name="drzava" type="text"/>
            <div class="flex flex-lg-row flex-col">
                <div class="flex w-full w-lg-1/2 flex-col pr-2">
                    <label for="gard" class="text-xl my-3">Grad* :</label>
                    <input class="input-style mb-3" name="grad" type="text"/>
                </div>
                <div class="flex w-full w-lg-1/2 flex-col pl-2">
                    <label for="postcode" class="text-xl my-3">Postanski broj* :</label>
                    <input class="input-style mb-3" name="postcode" type="number"/>
                </div>
            </div>
            <label for="adresa" class="text-xl my-3">Adresa* :</label>
            <input class="input-style mb-3" name="adresa" type="text"/>
            <label for="email" class="text-xl my-3">E-mail* :</label>
            <input class="input-style mb-3" name="email" type="text"/>
            <label for="tel" class="text-xl my-3">Telefon* :</label>
            <input class="input-style mb-3" name="tel" type="number"/>
            <div class="flex flex-lg-row flex-col">
                <div class="flex w-full w-lg-1/2 flex-col pr-2">
                    <label for="pib" class="text-xl my-3">PIB* :</label>
                    <input class="input-style mb-3" name="pib" type="number"/>
                </div>
                <div class="flex w-full w-lg-1/2 flex-col pl-2">
                    <label for="maticni_broj" class="text-xl my-3">Maticni broj* :</label>
                    <input class="input-style mb-3" name="maticni_broj" type="number"/>
                </div>
            </div>
            <label for="bank_account" class="text-xl my-3">Bank account :</label>
            <input class="input-style mb-3" name="bank_account" type="number"/>
            <div class="flex flex-lg-row flex-col">
                <div class="flex w-full w-lg-1/2 flex-col pr-2">
                    <label for="tekuci_racun" class="text-xl my-3">Tekuci racun* :</label>
                    <input class="input-style mb-3" name="tekuci_racun" type="number"/>
                </div>
                <div class="flex w-full w-lg-1/2 flex-col pl-2">
                    <label for="naziv_banke" class="text-xl my-3">Naziv banke* :</label>
                    <input class="input-style mb-3" name="naziv_banke" type="text"/>
                </div>
            </div>
            <label for="logo" class="text-xl my-3">Logo firme* :</label>
            <input class="" name="logo" id="logo" type="file" accept=".jpg,.jpeg,.png" onchange="validateFileType()"/>

            <button type="submit" class="finish-btn mt-5 text-xl">Sacuvaj podatke</button>
        </form>
    </div>
    <script>
        function validateFileType(){
            var fileName = document.getElementById("logo").value;
            var idxDot = fileName.lastIndexOf(".") + 1;
            var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
            if (extFile!="jpg" && extFile!="jpeg" && extFile!="png"){
                Swal.fire(
                    'Only jpg/jpeg and png files are allowed!',
                    '',
                    'error'
                );
            }
        }
    </script>
    @endif
</x-worker-profile-layout>