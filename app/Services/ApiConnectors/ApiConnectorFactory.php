<?php

namespace App\Services\ApiConnectors;

use App\Services\ApiConnectors\Connections\AuthConnection;
use App\Services\ApiConnectors\Connections\CounterpartyConnection;
use App\Services\ApiConnectors\Connections\TenderConnection;
use App\Services\ApiConnectors\Connections\UsersConnection;

class ApiConnectorFactory
{
    public static function userApi(): UsersConnection
    {
        return new UsersConnection();
    }

    public static function authApi(): AuthConnection
    {
        return new AuthConnection();
    }

    public static function tenderApi(): TenderConnection
    {
        return new TenderConnection();
    }

    public static function counterpartyApi(): CounterpartyConnection
    {
        return new CounterpartyConnection();
    }
}
