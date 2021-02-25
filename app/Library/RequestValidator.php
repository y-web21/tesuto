<?php

namespace App\Library;

use Illuminate\Support\Facades\Validator as ValidatorFacede;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;

/**
 * Undocumented class
 */
class RequestValidator
{
    private static $message = [
        'image.required' => '画像がありません',
        'image.mimes' => 'がぞーを指定しろよ・・・',
        'image.max' => 'おっきいなぁ',
        'page.integer' => 'ページ指定が無効です',
        'page.between' => '指定されたページは存在しません',
    ];


    /**
     * ページネーション要求のバリデーションを行います
     *
     * @param Request $request
     * @param integer $lastPage
     * @return Validator
     */
    public static function pagination(Request $request, int $lastPage): Validator
    {
        $target = [
            'page' => empty($request->page) === true ? 1 : $request->page,
        ];

        $rules = [
            'page' => 'integer | between:1,' . $lastPage,
        ];

        return ValidatorFacede::make($target, $rules, self::$message);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return Validator
     */
    public static function uploadImage(Request $request): Validator
    {
        $rules = [
            // 'description'                  => 'required ',
            'image' => 'required | mimes:jpeg,gif,png | max:10240',
        ];

        return ValidatorFacede::make($request->all(), $rules, self::$message);
    }
}
