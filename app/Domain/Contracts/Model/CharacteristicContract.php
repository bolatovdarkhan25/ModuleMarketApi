<?php

namespace App\Domain\Contracts\Model;

interface CharacteristicContract
{
    public const TABLE_NAME = 'characteristics';

    public const FIELD_ID        = 'id';
    public const FIELD_PREFIX    = 'prefix';
    public const FIELD_NAME      = 'name';
    public const FIELD_DATA_TYPE = 'data_type';
    public const FIELD_COMMON    = 'common';

    public const FILLABLES_LIST = [
        self::FIELD_PREFIX,
        self::FIELD_NAME,
        self::FIELD_DATA_TYPE,
        self::FIELD_COMMON
    ];

    public const SEEDER_DATA = [
        'ram' => 'ОЗУ',
        'cpu' => 'Процессор',
        'num_of_cores' => 'Количество ядер',
        'weight' => 'Вес',
        'diagonal' => 'Диагональ',
        'color' => 'Цвет',
        'wired' => 'Проводной',
        'size' => 'Размер',
        'textile' => 'Ткань',
        'thickness' => 'Толщина',
        'hooded' => 'С капюшоном',
        'pants_type' => 'Тип брюк',
        'wood_type' => 'Тип древесины',
        'length' => 'Длина',
        'width' => 'Ширина',
        'diameter' => 'Диаметр',
        'steel_grade' => 'Марка стали',
        'fat_content' => 'Жирность',
        'expiration_date' => 'Срок годности',
        'volume' => 'Объем',
        'sort' => 'Сорт',
        'per_of_proteins' => 'Процент белков',
        'per_of_fat' => 'Процент жиров',
        'clothe_material' => 'Материал одежды'
    ];
}
