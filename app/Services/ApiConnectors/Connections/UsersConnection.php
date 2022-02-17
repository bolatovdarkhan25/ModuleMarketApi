<?php

namespace App\Services\ApiConnectors\Connections;

use App\Services\ApiConnectors\ApiConnector;

class UsersConnection extends ApiConnector
{
    public function __construct(string $service = 'users')
    {
        parent::__construct($service);
    }
}
