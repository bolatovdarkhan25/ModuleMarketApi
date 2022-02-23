<?php

namespace App\Domain\Repositories;

use App\Domain\Core\BaseRepository;
use App\Models\Characteristic;

class CharacteristicRepository extends BaseRepository
{
    public function model(): string
    {
        return Characteristic::class;
    }
}
