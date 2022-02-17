<?php

namespace App\Http\Middleware;

use App\Services\ApiConnectors\ApiConnectorFactory;
use App\Traits\ApiResponse;
use Closure;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class AuthMiddleware
{
    use ApiResponse;

    private string $url;
    private array $params;
    private array $headers;

    public function __construct()
    {
        $this->url = 'api/access';
        $this->params = [];
        $this->headers = [];
    }

    public function handle(Request $request, Closure $next)
    {
        $this->headers = [
            'Authorization' => 'Bearer ' . $request->bearerToken()
        ];

        try {
            $authConnection = ApiConnectorFactory::authApi();
            $response = $authConnection->get($this->url, $this->params, $this->headers);

            $responseData = json_decode($response->getBody()->getContents(), true);
        } catch (Exception|GuzzleException $exception) {
            if ($exception->getCode() !== 401) {
                return $this->errorResponse(500, $exception->getMessage());
            }

            return $this->errorResponse(401, "Вы не авторизованы.");
        }

        $request->merge([
            'user_id' => $responseData['data']['user_id'],
        ]);

        return $next($request);
    }
}
