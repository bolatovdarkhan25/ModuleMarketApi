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
     * @OA\Get(
     *     path="/api/v1/categories/get-list-by-group-with-subcategories",
     *     summary = "Get categories and subcategories list by group id",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="group_id",
     *         in="query",
     *         description="ID of group",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Returns data"
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Internal unhandled error",
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Validation error",
     *     )
     * )
     *
     * @throws UnknownProperties
     */
    public function getListByGroupIdWithSubcategories(GetListByGroupIdWithSubcategoriesRequest $request): JsonResponse
    {
        $data = new GetListByGroupIdWithSubcategoriesRequestDTO(groupId: $request->query('group_id'));

        return $this->returnResponse([
            'data'    => $this->categoryService->getListByGroupIdWithSubcategories($data),
            'message' => 'List of categories related with subcategories by group id',
            'status'  => Response::HTTP_OK
        ]);
    }
}
