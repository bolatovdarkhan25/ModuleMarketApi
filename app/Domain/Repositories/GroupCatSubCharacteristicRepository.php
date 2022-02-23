<?php

namespace App\Domain\Repositories;

use App\Domain\Core\BaseRepository;
use App\Models\GroupCatSubCharacteristic;

class GroupCatSubCharacteristicRepository extends BaseRepository
{
    public function model(): string
    {
        return GroupCatSubCharacteristic::class;
    }
}
