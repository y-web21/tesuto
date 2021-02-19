<?php

namespace App\Library;

use App\Models\User;

class Helper
{
    const id = 1;
    public int $variable;

    public function __construct(int $variable = 1)
    {
        $this->variable = $variable;
    }

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

    public static function getUser()
    {
        // 現在のログインユーザからidを取得する
        $user_id = random_int(0, 10);
        $user_id = self::id;
        // $user_id = self::testauthor
        // $user_name1 = User::where('id', '=', $user_id);
        // $user_name2 = $user_name1->first();
        // $user_name3 = $user_name2->toArray();
        // $user_name4 = $user_name3['name'];
        try {
            $user_name = User::where('id', '=', $user_id)->first()->toArray()['name'];
        } catch (\Throwable $th) {
            $user_name = '君、誰や。';
            echo $th->getMessage();
        }

        return array($user_id, $user_name);
    }

}
