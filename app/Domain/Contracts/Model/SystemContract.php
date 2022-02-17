<?php

namespace App\Domain\Contracts\Model;

interface SystemContract
{
    public const TABLE_NAME = 'systems';

    public const FIELD_ID          = 'id';
    public const FIELD_NAME        = 'name';
    public const FIELD_DESCRIPTION = 'description';
    public const FIELD_API_TOKEN   = 'api_token';

    public const FILLABLES_LIST = [
        self::FIELD_NAME,
        self::FIELD_DESCRIPTION,
        self::FIELD_API_TOKEN
    ];
}
