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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id' => '499019326539-fsisln8v7tsqkte2nffghek5unhe4r1r.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => env('REDIRECT_GOOGLE_URL', 'REDIRECT_GOOGLE_DOMAIN'),
    ],

    'linkedin' => [
        'client_id' => '86s9lvjl6tjksw',
        'client_secret' => 'HHRrdbI5aVL7XLxH',
        'redirect' => env('REDIRECT_LINKEDIN_URL', 'REDIRECT_LINKEDIN_DOMAIN'),
    ],

];
