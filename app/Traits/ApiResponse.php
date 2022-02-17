<?php


namespace App\Traits;


use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    protected function successResponse($code = 200, $message = null, $data = null): JsonResponse
    {
        return response()->json([
            'status'  => true,
            'message' => $message,
            'data'    => $data
        ], $code, [], JSON_UNESCAPED_UNICODE);
    }

    protected function errorResponse($code, $message = null, $data = null): JsonResponse
    {
        return response()->json([
            'status'  => false,
            'message' => $message,
            'data'    => $data
        ], $code, [], JSON_UNESCAPED_UNICODE);
    }

    protected function returnResponse(array $response): JsonResponse
    {
        if ($response['status'] < 400) {
            return $this->successResponse($response['status'], $response['message'], $response['data']);
        } else {
            return $this->errorResponse($response['status'], $response['message'], $response['data']);
        }
    }
}
