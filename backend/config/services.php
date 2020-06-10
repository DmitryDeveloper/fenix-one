<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    | mailgun email = ivanenkoaleksei17081994@gmail.com
    | mailgun password = F1e2n3i4x5.one
    |
    */

    'mailgun' => [
        'domain' => 'sandbox2e4e17049bd54fc5bba78e916ff96b6d.mailgun.org',
        'secret' => '4f21feee1ef08c339fa6e7f8eaaeb92f-8b34de1b-2e776588',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

];
