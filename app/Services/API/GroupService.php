<?php

namespace App\Services\API;

use App\Domain\Repositories\GroupRepository;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class GroupService
{
    private GroupRepository $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    /**
     * @return EloquentCollection
     */
    public function getAll(): EloquentCollection
    {
        return $this->groupRepository->all();
    }
}
