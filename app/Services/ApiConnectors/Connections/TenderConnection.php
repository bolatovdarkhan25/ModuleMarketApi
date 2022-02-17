<?php

namespace App\Services\ApiConnectors\Connections;

use App\Services\ApiConnectors\ApiConnector;

class TenderConnection extends ApiConnector
{
    public function __construct(string $service = 'tender')
    {
        parent::__construct($service);
    }
}
