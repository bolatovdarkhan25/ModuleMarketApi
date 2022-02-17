<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @OA\Info(
     *   title="Module Marketing Documentation",
     *   version="1.0",
     *   @OA\Contact(
     *     email="info@adata.kz",
     *     name="Adata Team"
     *   )
     * )
     * @OA\SecurityScheme(
     *     type="http",
     *     in="header",
     *     securityScheme="bearer",
     *     scheme="bearer"
     * )
     */

    public function info(): JsonResponse
    {
        return response()->json(['version' => App::version(), 'welcome_message' => 'Welcome to Module Marketing']);
    }
}
