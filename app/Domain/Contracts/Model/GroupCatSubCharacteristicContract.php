<?php

namespace App\Domain\Contracts\Model;

interface GroupCatSubCharacteristicContract
{
    public const TABLE_NAME = 'group_cat_subs_characteristics';

    public const FIELD_ID                            = 'id';
    public const FIELD_GROUP_CATEGORY_SUBCATEGORY_ID = 'group_category_subcategory_id';
    public const FIELD_CHARACTERISTIC_ID             = 'characteristic_id';

    public const FILLABLES_LIST = [
        self::FIELD_GROUP_CATEGORY_SUBCATEGORY_ID,
        self::FIELD_CHARACTERISTIC_ID
    ];
}

