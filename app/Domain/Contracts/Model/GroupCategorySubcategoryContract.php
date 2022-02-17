<?php

namespace App\Domain\Contracts\Model;

interface GroupCategorySubcategoryContract
{
    public const TABLE_NAME = 'group_category_subcategories';

    public const FIELD_ID                = 'id';
    public const FIELD_GROUP_CATEGORY_ID = 'group_category_id';
    public const FIELD_SUBCATEGORY_ID    = 'subcategory_id';

    public const FILLABLES_LIST = [
        self::FIELD_GROUP_CATEGORY_ID,
        self::FIELD_SUBCATEGORY_ID
    ];
}
