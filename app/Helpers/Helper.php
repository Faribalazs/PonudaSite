<?php

namespace App\Helpers;

class Helper
{
    public static function getCurrentUrlWithLocale(string $locale) {

        $segments = request()->segments();
        $segments[0] = $locale;

        return implode('/', $segments);
    }

    public static function worker()
    {
        return auth('worker')->user()->id ?? null;
    }
}