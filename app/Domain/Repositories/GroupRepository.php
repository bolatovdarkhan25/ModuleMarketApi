<?php

namespace App\Domain\Repositories;

use App\Domain\Core\BaseRepository;
use App\Models\Group;

class GroupRepository extends BaseRepository
{
    public function model(): string
    {
        return Group::class;
    }
}
