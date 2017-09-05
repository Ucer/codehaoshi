<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    // Self add services config
    'github' => [
        'client_id'     => env('CLIENT_ID'),
        'client_secret' => env('CLIENT_SECRET'),
        'redirect'      => str_finish(env('APP_URL'), '/').'login/github/callback',// str_finish方法是 laravel 自带的助手函数
    ],
    'youdao' => [
        'appKey' => env('YOUDAO_APP_KEY'),
        'appSecret' => env('YOUDAO_APP_SECRET'),
    ],

];
