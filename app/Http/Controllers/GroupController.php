<?php

namespace App\Http\Controllers;

use App\Services\API\GroupService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GroupController extends Controller
{
    private GroupService $groupService;

    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/groups",
     *     summary = "Get groups list",
     *     tags={"Groups"},
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
     **/
    public function index(Request $request): JsonResponse
    {
        return $this->returnResponse([
            'data'    => $this->groupService->getAll(),
            'message' => 'Groups list',
            'status'  => Response::HTTP_OK
        ]);
    }
}
