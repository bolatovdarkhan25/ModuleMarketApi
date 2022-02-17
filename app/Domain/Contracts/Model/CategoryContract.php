<?php

namespace App\Domain\Contracts\Model;

interface CategoryContract
{
    public const TABLE_NAME = 'categories';

    public const FIELD_ID   = 'id';
    public const FIELD_NAME = 'name';

    public const FILLABLES_LIST = [
        self::FIELD_NAME
    ];
}
