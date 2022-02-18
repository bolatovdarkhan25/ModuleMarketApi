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

    public const SEEDER_DATA = [
        'avt' => 'Аудио, Видео, ТВ',
        'appliance' => 'Бытовая техника',
        'children' => 'Детские товары',
        'lebook' => 'Досуг, книги',
        'household' => 'Хозяйственные товары',
        'stationery' => 'Канцелярские товары',
        'computer' => 'Компьютеры',
        'beatyhealth' => 'Красота и здоровье',
        'furniture' => 'Мебель',
        'medical' => 'Медицинские товары',
        'shoes' => 'Обувь',
        'clothes' => 'Одежда',
        'secsafe' => 'Охрана и безопасность',
        'holidaypar' => 'Праздничная атрибутика',
        'food' => 'Продукты питания',
        'profequipment' => 'Профессиональное оборудование',
        'agriculture' => 'Сельское хозяйство',
        'symbolism' => 'Символика',
        'sportour' => 'Спорт, туризм',
        'constr_repair' => 'Строительство, ремонт',
        'telgadget' => 'Телефоны и гаджеты',
        'fuel' => 'Топливо',
        'homegarden' => 'Товары для дома и дачи',
        'office' => 'Товары для офиса',
        'pet' => 'Товары для животных',
        'edueqipment' => 'Учебное оборудование',
        'jewacc' => 'Украшения и аксессуары',
        'watersupsew' => 'Водоснабжение и канализация'
    ];
}
