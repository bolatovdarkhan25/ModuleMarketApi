<?php

namespace App\Domain\Repositories;

use App\Domain\Core\BaseRepository;
use App\Models\GroupCatSubCharValue;

class GroupCatSubCharValueRepository extends BaseRepository
{
    public function model(): string
    {
        return GroupCatSubCharValue::class;
    }
}
