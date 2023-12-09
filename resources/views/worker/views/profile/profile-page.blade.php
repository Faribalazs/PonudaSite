<x-worker-profile-layout>
    <x-slot name="pageTitle">
        {{ __("app.profile.my-account") }}
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <div class="flex profile-title">
        <p class="text-3xl font-bold">{{ __("app.profile.my-account") }}</p>
    </div>
    <div class="flex mt-3 flex-col">
        @php 
            $minFill = 4;
            $censored_email = preg_replace_callback(
                '/^(.)(.*?)([^@]?)(?=@[^@]+$)/u',
                function ($m) use ($minFill) {
                    return $m[1]
                            . str_repeat("*", max($minFill, mb_strlen($m[2], 'UTF-8')))
                            . ($m[3] ?: $m[1]);
                },
                Auth::user()->email
            );
        @endphp
        <div class="mt-3">
            <p class="text-xl"><b>{{ __("app.profile.email") }} :</b> {{ $censored_email }}</p>
        </div>
    </div> 
    <form method="POST" action="{{ route('worker.personal.account.settings.change-data') }}" enctype='multipart/form-data'>
        @csrf
        @method('PUT')
        <!-- Phone -->
        <div class="mt-3">
            <x-label for="phone" :value="'Phone'" class="pl-3"/>
            <x-input id="phone" class="block mt-1 w-full rounded-3xl" type="text" name="phone"
                    :value="old('phone')" value="{{ auth('worker')->user()->phone }}"/>
        </div>
        <!-- CV -->
        <div class="mt-3">
            <x-label for="cv" :value="'CV'" class="pl-3"/>
            <textarea id="cv" name="cv" rows="3" class="block mt-1 w-full rounded-3xl" :value="old('cv')">{{ auth('worker')->user()->cv }}</textarea>
        </div>
         <!-- Image -->
         <div class="mt-5">
            <x-label for="user_image" :value="'Profile image'" class="pl-3"/><br/>
            @if(auth('worker')->user()->image !== null)
                <img src="{{ route('show.avatar', ['filename' => auth('worker')->user()->image]) }}" style="width:160px; height:160px; object-fit: cover;"><br>
                
            @endif
            <input id="user_image" class="block w-full pl-3 mb-5 form-control" type="file" name="user_image"/>
        </div>
        <div class="d-flex align-items-baseline justify-content-between mt-4 form-buttons">
            <button class="mt-3 confirm-btn">
                Update Profile
            </button>
        </div>
    </form>
</x-worker-profile-layout>
