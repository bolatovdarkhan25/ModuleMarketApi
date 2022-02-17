<?php

namespace App\Services\ApiConnectors\Connections;

use App\Services\ApiConnectors\ApiConnector;

class AuthConnection extends ApiConnector
{
    public function __construct(string $service = 'auth')
    {
        parent::__construct($service);
    }
}
