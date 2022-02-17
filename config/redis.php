<?php

return [
    'host'     => env('REDIS_HOST', '127.0.0.1'),
    'port'     => env('REDIS_PORT', '6379'),
    'password' => env('REDIS_PASSWORD', ''),
    'scheme'   => env('REDIS_SCHEME', 'tcp')
];
