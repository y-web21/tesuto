<?php

namespace App\Library;

class Helper
{
    public static function strlimit($value, $limit = 100, $end = '...')
    {
        if (mb_strlen($value, 'UTF-8') <= $limit) {
            return $value;
        }
        return rtrim(mb_substr($value, 0, $limit, 'UTF-8')) . $end;
    }

    public static function acho()
    {
        return 'あちょ～';
    }
}
