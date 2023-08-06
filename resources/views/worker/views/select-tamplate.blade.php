<x-app-worker-layout>
    <x-slot name="pageTitle">
        Izaberi izgled
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <div class="flex">

    </div>
    <div class="flex">
        <form method="POST" action="{{ route('worker.archive.genarte.tamplate.pdf') }}" class="mt-5 w-full">
            @csrf
            <input type="hidden" name="ponuda_id" value="{{$ponuda_id}}"/>
            <div class="radio-btn-container">
                <ul class="radio-img">
                    <li>
                        <input type="radio"name="temp" id="cb1" value="default" />
                        <label for="cb1"><img src="{{ asset('img/defautpdf.png') }}" /></label>
                        <span>Obican sablon</span>
                    </li>
                </ul>
                <ul class="radio-img">
                    <li>
                        <input type="radio"name="temp" id="cb2" value="template-one" />
                        <label for="cb2"><img src="{{ asset('img/newtamplate.png') }}" /></label>
                        <span>Novi sablon</span>
                    </li>
                </ul>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="finish-btn mt-4">
                    Generisi PDF
                </button>
            </div>
        </form>
    </div>
<style>
    ul {
        list-style-type: none;
    }

    li {
        display: inline-block;
    }

    input[type="radio"][id^="cb"] {
        display: none;
    }

    label {
        border: 1px solid #fff;
        padding: 10px;
        display: block;
        position: relative;
        margin: 10px;
        cursor: pointer;
    }

    label:before {
        background-color: #B87333;
        color: white;
        content: " ";
        display: block;
        border-radius: 50%;
        border: 1px solid #B87333;
        border-radius: 10px;
        position: absolute;
        top: -5px;
        left: -5px;
        width: 25px;
        height: 25px;
        text-align: center;
        line-height: 28px;
        transition-duration: 0.4s;
        transform: scale(0);
    }

    label img {
        width: 300px;
        transition-duration: 0.2s;
        transform-origin: 50% 50%;
        border: 2px solid rgb(192, 192, 192);
        border-radius: 10px;
    }

    input[type="radio"]:checked+label {
        border-color: #B87333;
        border-radius: 10px;
    }

    input[type="radio"]:checked+label:before {
        content: "✓";
        background-color: #B87333;
        transform: scale(1);
    }

    input[type="radio"]:checked+label img {
        transform: scale(0.9);
        box-shadow: 0 0 5px #333;
        z-index: -1;
    }

    .radio-btn-container {
        display: grid;
        grid-gap: 1rem;
        margin: auto;
        width: 100%;
    }

    .radio-img {
        text-align: center;
    }

    @media (min-width: 600px) {
        .radio-btn-container {
            grid-template-columns: repeat(1, 1fr);
        }
        label img {
            width: 100%;
        }
    }

    @media (min-width: 950px) {
        .radio-btn-container {
            grid-template-columns: repeat(2, 1fr) !important;
        }
        label img {
            width: 300px;
        }
    }

    @media (min-width: 1400px) {
        .radio-btn-container {
            grid-template-columns: repeat(2, 1fr) !important;
        }

        label img {
            width: 450px;
        }
    }
</style>
</x-app-worker-layout>
