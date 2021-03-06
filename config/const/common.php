<?php

return [
    'ARTICLE' => [
        'DEFAULT_STATUS' => 4,
    ],
    'TABLE_COLUMN' => [
        'upload_images' => [
            0 => "id",
            1 => "path",
            2 => "name",
            3 => "description",
            4 => "user_id",
            5 => "delete_request",
            6 => "created_at",
            7 => "updated_at",
        ],
    ],
    'PAGINATION' => [
        'PER_PAGE' => [
            'IMAGES' => 10,
        ],
    ],
    'BLADE' => [
        'GNAV' => [
            'DISABLE' => 0,
            'ENABLE' => 1,
        ],
        'HEADER' => [
            'NONE' => -1,
            'SMALL' => 1,
            'LARGE' => 2,
        ],
        'FOOTER' => [
            'DISABLE' => 0,
            'ENABLE' => 1,
        ],
        'LNAV' => [
            'DISABLE' => 0,
            'POSTER' => 1,
        ],
    ],
];
