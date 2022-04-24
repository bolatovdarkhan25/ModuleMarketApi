<?php

namespace App\Domain\Repositories;

use App\Domain\Contracts\Entity\CategoryContract;
use App\Domain\Core\BaseRepository;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository extends BaseRepository
{

    public function model(): string
    {
        return Category::class;
    }

    public function getAllWithGroups(array $columns = ['*']): Collection|array
    {
        return $this->getModel()->newQuery()->with(CategoryContract::GROUPS_RELATION)->get($columns);
    }
}
