<?php

namespace App\Services\API;

use App\Domain\Repositories\CategoryRepository;
use App\DTO\FromRequests\Category\GetListByGroupIdWithSubcategoriesRequestDTO;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class CategoryService
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getListByGroupIdWithSubcategories(GetListByGroupIdWithSubcategoriesRequestDTO $data): EloquentCollection
    {
        return $this->categoryRepository->getCategoriesAndSubcategoriesByGroup($data->groupId);
    }
}
