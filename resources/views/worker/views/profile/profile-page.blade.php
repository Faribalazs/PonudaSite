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
            <p class="text-xl"><b>E-mail :</b> {{ $censored_email }}</p>
        </div>
    </div>
    
</x-worker-profile-layout>
