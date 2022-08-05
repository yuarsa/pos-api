<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;

class AcceptHeader
{
    public function handle($request, Closure $next, $guard = null)
    {
        if ($request->header('content-type') != 'application/json') {
            return response([
                'error' => [
                    'status' => Response::HTTP_BAD_REQUEST,
                    'message' => 'Request must contain json',
                ],
            ], Response::HTTP_BAD_REQUEST);
        }

        return $next($request);
    }
}