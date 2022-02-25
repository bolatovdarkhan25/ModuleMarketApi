<?php

namespace App\Domain\Repositories;

use App\Domain\Contracts\Model\CategoryContract;
use App\Domain\Contracts\Model\GroupCategoryContract;
use App\Domain\Contracts\Model\GroupCategorySubcategoryContract;
use App\Domain\Contracts\Model\GroupContract;
use App\Domain\Contracts\Model\SubcategoryContract;
use App\Domain\Core\BaseRepository;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository extends BaseRepository
{

    public function model(): string
    {
        return Category::class;
    }

    public function getCategoriesAndSubcategoriesByGroup(int $groupId): Collection|array
    {
        return $this->query()
            ->join(
                GroupCategoryContract::TABLE_NAME,
                CategoryContract::TABLE_NAME . '.' . CategoryContract::FIELD_ID,
                '=',
                GroupCategoryContract::TABLE_NAME . '.' . GroupCategoryContract::FIELD_CATEGORY_ID
            )->join(
                GroupContract::TABLE_NAME,
                GroupContract::TABLE_NAME . '.' . GroupContract::FIELD_ID,
                '=',
                GroupCategoryContract::TABLE_NAME . '.' . GroupCategoryContract::FIELD_GROUP_ID,
            )->join(
                GroupCategorySubcategoryContract::TABLE_NAME,
                GroupCategoryContract::TABLE_NAME . '.' . GroupCategoryContract::FIELD_ID,
                '=',
                GroupCategorySubcategoryContract::TABLE_NAME . '.' . GroupCategorySubcategoryContract::FIELD_GROUP_CATEGORY_ID
            )->join(
                SubcategoryContract::TABLE_NAME,
                GroupCategorySubcategoryContract::TABLE_NAME . '.' . GroupCategorySubcategoryContract::FIELD_SUBCATEGORY_ID,
                '=',
                SubcategoryContract::TABLE_NAME . '.' . SubcategoryContract::FIELD_ID
            )->where(
                GroupContract::TABLE_NAME . '.' . GroupContract::FIELD_ID,
                '=', $groupId
            )->get([
                CategoryContract::TABLE_NAME . '.' . CategoryContract::FIELD_NAME . ' as category_name',
                SubcategoryContract::TABLE_NAME . '.' . SubcategoryContract::FIELD_NAME . ' as subcategory_name'
            ]);
    }
}
