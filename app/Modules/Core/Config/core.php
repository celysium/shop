<?php


return [
    'auth'   => [
        'middleware'    => env('AUTH_MIDDLEWARE', 'auth:sanctum'),
        'retry_time'    => env('AUTH_RETRY_TIME', 60),
        'code_lifetime' => env('AUTH_CODE_LIFETIME', 600),
        'max_retry'     => env('AUTH_MAX_RETRY', 5),
    ]
];
