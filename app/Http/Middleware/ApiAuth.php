<?php

namespace App\Http\Middleware;

use App\Services\Redis\RedisCache;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\Models\System;
use Closure;
use Illuminate\Http\Request;

class ApiAuth
{

    protected Auth $auth;
    protected RedisCache $redis;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
        $this->redis = new RedisCache();
    }

    public function handle(Request $request, Closure $next, $guard = null)
    {
        if($request->headers->has('apiToken')){
            if (!$this->redis->has('api_token', $request->header('apiToken'))) {

                if (System::query()
                        ->where('api_token', $request->header('apiToken'))
                        ->where('name', 'module_marketing')
                        ->first() !== null) {
                    $this->redis->set('api_token', $request->header('apiToken'));

                    return $next($request);
                }
            } else {
                return $next($request);
            }
        }

        return response()->json(
            [
                "success" => false,
                "data"    => "",
                "message" => "Неавторизованная система"
            ], 403
        );
    }
}
