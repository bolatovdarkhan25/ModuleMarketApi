<?php

namespace App\Domain\Contracts\Entity;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface GroupContract
{
    public const TABLE_NAME = 'groups';

    public const FIELD_ID     = 'id';
    public const FIELD_NAME   = 'name';
    public const FIELD_PREFIX = 'prefix';

    public const FILLABLES_LIST = [
        self::FIELD_NAME,
        self::FIELD_PREFIX
    ];

    public const SEEDER_DATA = [
        'electronics'  => 'Электроника',
        'clothes'      => 'Одежда',
        'construction' => 'Строительство',
        'food'         => 'Продовольствие'
    ];

    public const CATEGORIES_RELATION = 'categories';

    public function categories(): BelongsToMany;
}
