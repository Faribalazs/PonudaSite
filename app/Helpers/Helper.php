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

    public static function transToCyrl($text)
    {
        if(empty($text))
            return "&nbsp";

        $latin = ['NJ','LJ','Nj','Lj','nj','lj','a','b','v','g','d','đ','e','ž','z','i','j','k','l','m','n','o','p','r','s','t','ć','u','f','h','c','č','š', 'A','B','V','G','D','Đ','E','Ž','Z','I','J','K','L','M','N','O','P','R','S','T','Ć','U','F','H','C','Č','Š','X','x'];
        $cyrillic = ['Њ','Љ','Њ','Љ','њ','љ','а','б','в','г','д','ђ','е','ж','з','и','ј','к','л','м','н','о','п','р','с','т','ћ','у','ф','х','ц','ч','ш', 'А','Б','В','Г','Д','Ђ','Е','Ж','З','И','Ј','К','Л','М','Н','О','П','Р','С','Т','Ћ','У','Ф','Х','Ц','Ч','Ш','КС','кс'];

        return str_replace($latin, $cyrillic, $text);
    }
}