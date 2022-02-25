<?php

namespace App\Http\Controllers;

use App\DTO\FromRequests\Category\GetListByGroupIdWithSubcategoriesRequestDTO;
use App\Http\Requests\Category\GetListByGroupIdWithSubcategoriesRequest;
use App\Services\API\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @throws UnknownProperties
     */
    public function getListByGroupIdWithSubcategories(GetListByGroupIdWithSubcategoriesRequest $request): JsonResponse
    {
        $data = new GetListByGroupIdWithSubcategoriesRequestDTO($request->validated());

        return $this->returnResponse([
            'data'    => $this->categoryService->getListByGroupIdWithSubcategories($data),
            'message' => 'List of categories related with subcategories by group id',
            'status'  => Response::HTTP_OK
        ]);
    }
}
