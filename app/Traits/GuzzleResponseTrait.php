<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Log;
use JetBrains\PhpStorm\ArrayShape;
use Throwable;

trait GuzzleResponseTrait
{
    /**
     * @throws Exception
     */
    private function checkResponse(array $responseBody = null): void
    {
        if (is_null($responseBody)) {
            throw new Exception('Что то пошло не так', 500);
        }

        $keys = ['data', 'message', 'status'];
        foreach ($keys as $key) {
            if (!array_key_exists($key, $responseBody)) {
                throw new Exception('Что то пошло не так', 500);
            }
        }
    }

    #[ArrayShape(['status' => "int", 'message' => "string", 'data' => "null"])]
    private function logErrorAndReturnResponse(Throwable $exception): array
    {
        $statusCode = $exception->getCode();

        if ($statusCode < 400 || $statusCode === 401) {
            $statusCode = 500;
        }

        if ($statusCode >= 500) {
            Log::error($exception->getMessage(), ['trace' => $exception->getTrace()]);
        }

        return ['status' => $statusCode, 'message' => $exception->getMessage(), 'data' => null];
    }
}
