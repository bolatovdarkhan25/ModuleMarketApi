<?php

namespace App\Domain\Contracts\Model;

interface CharacteristicValueContract
{
    public const TABLE_NAME = 'characteristic_values';

    public const FIELD_ID                = 'id';
    public const FIELD_VALUE             = 'value';
    public const FIELD_CHARACTERISTIC_ID = 'characteristic_id';

    public const FILLABLES_LIST = [
        self::FIELD_VALUE,
        self::FIELD_CHARACTERISTIC_ID
    ];
}

