<?php

namespace App\Domain\Contracts\Model;

interface GroupCategoryContract
{
    public const TABLE_NAME = 'group_categories';

    public const FIELD_ID          = 'id';
    public const FIELD_GROUP_ID    = 'group_id';
    public const FIELD_CATEGORY_ID = 'category_id';

    public const FILLABLES_LIST = [
        self::FIELD_GROUP_ID,
        self::FIELD_CATEGORY_ID
    ];
}
