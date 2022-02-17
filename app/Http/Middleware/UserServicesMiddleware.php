<?php

namespace App\Http\Middleware;

use App\Services\ApiConnectors\ApiConnectorFactory;
use App\Traits\ApiResponse;
use Closure;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserServicesMiddleware
{
    use ApiResponse;

    private string $url;
    private array $params;
    private array $headers;

    public function __construct()
    {
        $this->url = 'api/v1/services/check';
        $this->params = [];
        $this->headers = [];
    }

    public function handle(Request $request, Closure $next)
    {
        $service = $this->getServiceNameFromUrl($request);

        $this->params = [
            'code' => $service,
            'user_id' => $request['user_id']
        ];

        $this->headers = [
            'Authorization' => 'Bearer ' . $request->bearerToken()
        ];

        try {
            $usersConnection = ApiConnectorFactory::userApi();
            $response = $usersConnection->get($this->url, $this->params, $this->headers);

            $responseData = json_decode($response->getBody()->getContents(), true);
        } catch (Exception|GuzzleException $exception) {
            Log::error(
                $exception->getMessage(), ['Location' => $exception->getFile(), 'Line' => $exception->getLine(), request()->user_id ?? 'Неавторизованный пользователь', '_url' => request()->_url]
            );
            $exceptionMessage = json_decode($exception->getMessage(), true);

            if (isset($exceptionMessage['success']) && !$exceptionMessage['success']) {
                return $this->errorResponse(403, $exceptionMessage['message']);
            }
            abort(403, 'Access denied');
        }

        if (isset($responseData['success']) && !$responseData['success']) {
            return $next($request);
        }
    }

    private function getServiceNameFromUrl(Request $request): string
    {
        $action = $request->route()[1];

        return $action['as'] ?? explode('data/', $request->url())[1];
    }
}
