<?php

return [
    'users' => [
        'base_url' => env('MODULE_USER_API_URL', ''),
        'options' => [
            'headers' => [
                'Accept' => 'application/json',
                'apiToken' => env('MODULE_USER_API_TOKEN'),
            ],
            'timeout' => 8.0,
        ]
    ],

    'tender' => [
        'base_url' => env('MODULE_TENDER_API_URL', ''),
        'options'  => [
            'headers' => [
                'Accept'    => 'application/json',
                "apiToken"  => env('MODULE_TENDER_API_TOKEN'),
            ],
            'timeout' => 8.0,
        ]
    ],

    'auth' => [
        'base_url' => env('MODULE_AUTH_API_URL', ''),
        'options'  => [
            'headers' => [
                'Accept'    => 'application/json',
                'apiToken'  => env('MODULE_AUTH_API_TOKEN'),
            ],
            'timeout' => 8.0,
        ]
    ],

    'counterparty' => [
        'base_url' => env('MODULE_COUNTERPARTY_API', ''),
        'options'  => [
            'headers' => [
                'Accept'    => 'application/json',
                'apiToken'  => env('MODULE_COUNTERPARTY_API_TOKEN'),
            ],
            'timeout' => 8.0,
        ]
    ],
];
