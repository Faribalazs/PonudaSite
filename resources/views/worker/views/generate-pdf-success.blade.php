<x-app-worker-layout>
    <x-slot name="pageTitle">
        Generiši PDF
    </x-slot>
    <x-slot name="header">
        Generiši PDF
    </x-slot>
    <div class="bar-div">
        <div class="mt20">
            <p class="text-center text-4xl py-14 font-bold">
                Ponuda se generise
            </p>
        </div>
        <div class="progress-bar"></div>
        <h1 class="count pt-5"></h1>
    </div>
    <form method="POST" action="{{ route('worker.archive.download.tamplate.pdf') }}" class="mt-5 w-full">
        @csrf
        @if (isset($client_id))
            <input type="hidden" name="client_id" value="{{ $client_id }}" />
        @endif
        @if (isset($type))
            <input type="hidden" name="type" value="{{ $type }}" />
        @endif
        @if (isset($ponuda_id))
            <input type="hidden" name="ponuda_id" value="{{ $ponuda_id }}" />
        @endif
        @if (isset($temporary))
            <input type="hidden" name="temporary" value="{{ $temporary }}" />
        @endif
        @if (isset($temp))
            <input type="hidden" name="temp" value="{{ $temp }}" />
        @endif
        <div class="justify-center mt-20 form1 flex-col">
           <div class="flex justify-center">
                <div class="sa">
                    <div class="sa-success">
                        <div class="sa-success-tip"></div>
                        <div class="sa-success-long"></div>
                        <div class="sa-success-placeholder"></div>
                        <div class="sa-success-fix"></div>
                    </div>
                </div>
           </div>
            <p class="text-center text-4xl font-bold">
                Ponuda je uspesno generisan <i class="ri-check-double-line"></i>
            </p>
            <p class="text-center text-2xl mt-10">
                Ponudu mozete skinuti i mozete popuniti ugovor
            </p>
            <button type="submit" name="skini" value="skini" class="w-1/2 mx-auto text-xl font-bold finish-btn mt-20">
                Skini PDF
            </button><br>
            <p class="text-2xl text-center">
                ili
            </p>
            <button type="submit" name="posalji" value="posalji" class="w-1/2 mx-auto text-xl font-bold finish-btn mt-5">
                Pošalji PDF u E-mail
            </button>
        </div>
    </form>
    <form class="form2">
        <button type="submit" name="skini" value="skini" class="w-1/2 mx-auto text-xl font-bold finish-btn mt-5">
            Izpuni ugovor
        </button>
    </form>
    <script>
        var body = document.querySelector('body'),
            bar = document.querySelector('.progress-bar'),
            form1 = document.querySelector('.form1'),
            form2 = document.querySelector('.form2'),
            counter = document.querySelector('.count'),
            barDiv = document.querySelector('.bar-div'),
            mark = document.querySelector('#checkmark-svg'),
            i = 0,
            throttle = .99; // 0-1

        (function draw() {
            if (i <= 100) {
                var r = Math.random();

                requestAnimationFrame(draw);
                bar.style.width = i + '%';
                counter.innerHTML = Math.round(i) + '%';

                if (r < throttle) { // Simulate d/l speed and uneven bitrate
                    i = i + r;
                }
            } else {
                ;
                bar.className += " animate";
                form1.className += " show";
                form2.className += " show";
                counter.className += " animate";
                barDiv.className += " animate";
            }
        })();
    </script>
    <style>
        @keyframes dissapear {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }

            100% {
                display: none;
                opacity: 0;
            }
        }

        @keyframes show {
            0% {
                opacity: 0;
            }

            50% {
                opacity: 0.5;
            }

            100% {
                display: flex;
                opacity: 1;
            }
        }

        .animate {
            display: none;
            animation-name: dissapear;
            animation-duration: 500ms;
            animation-fill-mode: forwards;
        }

        .title-div {
            position: relative;
        }

        .form1,
        .form2 {
            display: none;
        }

        .show {
            display: flex !important;
            animation-name: show;
            animation-duration: 500ms;
            animation-fill-mode: forwards;
        }

        .hide {
            display: none !important;
        }

        .bar-div {
            height: 100%;
            position: relative;
            width: 80%;
            margin: auto;
            background-color: white;
        }

        .progress-bar {
            height: 10px;
            border-radius: 16px;
            background: #e8772e;
        }

        .done {
            width: 100%;
            background-color: transparent !important;
        }

        .count {
            width: 100%;
            text-align: center;
            font-weight: 100;
            font-size: 3em;
            color: #0d2c5a;
        }
    </style>

    {{-- Checkmark animation style --}}

    <style>
        .sa {
            width: 140px;
            height: 140px;
            padding: 26px;
            background-color: #fff;
        }

        .sa-success {
            border-radius: 50%;
            border: 4px solid #e8772e;
            box-sizing: content-box;
            height: 80px;
            padding: 0;
            position: relative;
            background-color: #fff;
            width: 80px;
        }

        .sa-success:after,
        .sa-success:before {
            background: #fff;
            content: '';
            height: 120px;
            position: absolute;
            transform: rotate(45deg);
            width: 60px;
        }

        .sa-success:before {
            border-radius: 40px 0 0 40px;
            width: 26px;
            height: 80px;
            top: -17px;
            left: 5px;
            transform-origin: 60px 60px;
            transform: rotate(-45deg);
        }

        .sa-success:after {
            border-radius: 0 120px 120px 0;
            left: 30px;
            top: -11px;
            transform-origin: 0 60px;
            transform: rotate(-45deg);
            animation: rotatePlaceholder 4.25s ease-in;
        }

        .sa-success-placeholder {
            border-radius: 50%;
            border: 4px solid #e8772e;
            box-sizing: content-box;
            height: 80px;
            left: -4px;
            position: absolute;
            top: -4px;
            width: 80px;
            z-index: 2;
            background-color: #e8772e;
        }

        .sa-success-fix {
            background-color: #fff;
            height: 90px;
            left: 28px;
            position: absolute;
            top: 8px;
            transform: rotate(-45deg);
            width: 5px;
            z-index: 1;
        }

        .sa-success-tip,
        .sa-success-long {
            background-color: #0d2c5a;
            border-radius: 2px;
            height: 5px;
            position: absolute;
            z-index: 5;
        }

        .sa-success-tip {
            left: 14px;
            top: 46px;
            transform: rotate(45deg);
            width: 25px;
            animation: animateSuccessTip 0.75s;
        }

        .sa-success-long {
            right: 8px;
            top: 38px;
            transform: rotate(-45deg);
            width: 47px;
            animation: animateSuccessLong 0.75s;
        }

        @keyframes animateSuccessTip {

            0%,
            54% {
                width: 0;
                left: 1px;
                top: 19px;
            }

            70% {
                width: 50px;
                left: -8px;
                top: 37px;
            }

            84% {
                width: 17px;
                left: 21px;
                top: 48px;
            }

            100% {
                width: 25px;
                left: 14px;
                top: 45px;
            }
        }

        @keyframes animateSuccessLong {

            0%,
            65% {
                width: 0;
                right: 46px;
                top: 54px;
            }

            84% {
                width: 55px;
                right: 0;
                top: 35px;
            }

            100% {
                width: 47px;
                right: 8px;
                top: 38px;
            }
        }

        @keyframes rotatePlaceholder {

            0%,
            5% {
                transform: rotate(-45deg);
            }

            100%,
            12% {
                transform: rotate(-405deg);
            }
        }
    </style>
</x-app-worker-layout>
