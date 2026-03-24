<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiSecretMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $secret = config('app.api_secret');

        if (!$secret || $request->header('X-Api-Secret') !== $secret) {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }

        return $next($request);
    }
}
