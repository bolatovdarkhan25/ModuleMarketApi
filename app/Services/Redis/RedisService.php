<?php

namespace App\Services\Redis;

use Predis\Client;

class RedisService
{
    private static bool $isConnected;
    private Client $client;

    public function __construct(int $index = 0)
    {
        $host     = config('redis.host');
        $port     = config('redis.port');
        $scheme   = config('redis.scheme');
        $password = config('redis.password');

        $parameters = [
            'scheme' => $scheme,
            'host'   => $host,
            'port'   => $port
        ];
        $options    = [
            'parameters' => [
                'password' => $password,
                'database' => $index
            ]
        ];

        if (!isset(self::$isConnected)) {
            $this->client      = new Client($parameters, $options);
            self::$isConnected = true;
        }
    }

    public function getClient(): Client
    {
        return $this->client;
    }
}
