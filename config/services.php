<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'facebook' => [
    'client_id' => '837671590580970',
    'client_secret' => 'd2938108c157a45508d2ab50f0bf7e3c',
    'redirect' => 'https://localhost/demo/oauth/facebook/callback',
],



// http://www.demo.com/auth/facebook/callback
    'google' => [
        'client_id' => '1021436299576-vr1lh866qa8pgl7ifedgg9skl8gbhqkh.apps.googleusercontent.com',
        'client_secret' => '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',
            'redirect' => 'http://localhost/demo/oauth/google/callback',

    ],



    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
