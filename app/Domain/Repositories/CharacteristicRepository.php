<?php

namespace App\Domain\Repositories;

use App\Domain\Contracts\Model\CharacteristicContract;
use App\Domain\Core\BaseRepository;
use App\Models\Characteristic;

class CharacteristicRepository extends BaseRepository
{
    public function model(): string
    {
        return Characteristic::class;
    }

    public function getDataTypesByColumn(string $column, array $values): array
    {
        return $this->getModel()
            ->newQuery()
            ->whereIn($column, $values)
            ->pluck(CharacteristicContract::FIELD_DATA_TYPE)
            ->toArray();
    }
}
