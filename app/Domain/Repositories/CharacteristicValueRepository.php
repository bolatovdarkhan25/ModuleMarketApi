<?php

namespace App\Domain\Repositories;

use App\Domain\Core\BaseRepository;
use App\Models\CharacteristicValue;

class CharacteristicValueRepository extends BaseRepository
{
    public function model(): string
    {
        return CharacteristicValue::class;
    }
}
