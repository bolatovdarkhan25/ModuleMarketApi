<?php

namespace App\Domain\Contracts\Model;

interface GroupCatSubCharValueContract
{
    public const TABLE_NAME = 'group_cat_sub_char_values';

    public const FIELD_ID                      = 'id';
    public const FIELD_GROUP_CAT_SUB_CHAR_ID   = 'group_category_subcategory_characteristic_id';
    public const FIELD_CHARACTERISTIC_VALUE_ID = 'characteristic_value_id';

    public const FILLABLES_LIST = [
        self::FIELD_GROUP_CAT_SUB_CHAR_ID,
        self::FIELD_CHARACTERISTIC_VALUE_ID
    ];
}

