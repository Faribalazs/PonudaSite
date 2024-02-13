<x-app-worker-layout>
    <x-slot name="pageTitle">
        {{ config('app.name') }}
    </x-slot>
    <x-slot name="header">
    </x-slot>
    @php
        if (auth('worker')->check()) {
            \App\Models\Tracker::hit();
        }
    @endphp

    <x-slot name="slider">
        <div class="swiper homePageSwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide relative">
                    <img src="{{ asset('img/slider-1.jpg') }}" />
                    <div class="gradient">
                        <span class="image-title">{{ __('app.slider.slider-one-title') }}</span>
                        <p class="image-text lg:w-1/2 w-10/12">
                            {{ __('app.slider.slider-one-text') }}
                        </p>
                        @if (!auth('worker')->check())
                            <a href="{{ route('worker.session.create') }}" class="slider-btn">
                                {{ __('app.slider.slider-one-btn-text') }}
                            </a>
                        @else
                            <a href="{{ route('worker.new.ponuda') }}" class="slider-btn">
                                {{ __('app.slider.slider-one-btn-text-logged-in') }}
                            </a>
                        @endif
                    </div>
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('img/slider-2.jpg') }}" />
                    <div class="gradient">
                        <span class="image-title">{{ __('app.slider.slider-two-title') }}</span>
                        <p class="image-text lg:w-1/2 w-10/12">
                            {{ __('app.slider.slider-two-text') }}
                        </p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('img/slider-3.jpg') }}" />
                    <div class="gradient">
                        <span class="image-title">{{ __('app.slider.slider-three-title') }}</span>
                        <p class="image-text lg:w-1/2 w-10/12">
                            {{ __('app.slider.slider-three-text') }}
                        </p>
                        <a href="{{ route('about.us') }}" class="slider-btn">
                            {{ __('app.slider.see-more') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </x-slot>

    <script>
        setTimeout(() => {
            var homePageSwiper = new Swiper(".homePageSwiper", {
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                autoplay: {
                    delay: 7000,
                    disableOnInteraction: true,
                },
            });
        }, 50);
    </script>

    <style>
        .page-padding {
            padding: 0px !important;
            width: 100% !important;
            margin-top: -98px !important;
        }

        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</x-app-worker-layout>
