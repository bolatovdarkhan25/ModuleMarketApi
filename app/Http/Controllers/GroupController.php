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
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return $this->returnResponse([
            'data'    => $this->groupService->getAll(),
            'message' => 'Groups list',
            'status'  => Response::HTTP_OK
        ]);
    }
}
