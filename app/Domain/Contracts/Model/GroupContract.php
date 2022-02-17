<?php

namespace App\Domain\Contracts\Model;

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

    public const SEEDER_NAMES = [
        'Аудио, Видео, ТВ',
        'Бытовая техника',
        'Детские товары',
        'Досуг, книги',
        'Хозяйственные товары',
        'Канцелярские товары',
        'Компьютеры',
        'Красота и здоровье',
        'Мебель',
        'Медицинские товары',
        'Обувь',
        'Одежда',
        'Охрана и безопасность',
        'Праздничная атрибутика',
        'Продукты питания',
        'Профессиональное оборудование',
        'Сельское хозяйство',
        'Символика',
        'Спорт, туризм',
        'Строительство, ремонт',
        'Телефоны и гаджеты',
        'Топливо',
        'Товары для дома и дачи',
        'Товары для офиса',
        'Товары для животных',
        'Учебное оборудование',
        'Украшения и аксессуары',
        'Водоснабжение и канализация'
    ];
}
