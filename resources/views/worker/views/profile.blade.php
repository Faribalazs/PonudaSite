<x-app-layout>
    <x-slot name="pageTitle">
        Worker Profile
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Dashboard for Worker') }} --}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in as a worker! <br>
                    Your name is: {{Auth::guard('worker')->user()->name}} <br>
                    Your email addrress: {{Auth::guard('worker')->user()->email}}
                    <form method="POST" action="{{ route('worker.logout') }}">
                        @csrf

                        <a href="route('logout')" class="text-white bg-red-700"
                            onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Logout') }}
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>