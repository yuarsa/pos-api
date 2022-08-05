<?php

namespace App\Http\Middleware;

use Illuminate\Cache\RateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class AttemptRequest
{
    protected $rateLimiter;

    public function __construct(RateLimiter $rateLimiter)
    {
        $this->rateLimiter = $rateLimiter;
    }

    protected function attemptRequestCalc($key, $max)
    {
        return $this->rateLimiter->retriesLeft($key, $max);
    }

    protected function attemptRequestLimitHeader(Response $response, $max, $remains, $retry = null)
    {
        $header = [
            'X-RateLimit-Limit' => $max,
            'X-RateLimit-Remaining' => $remains
        ];

        if(!is_null($retry)) {
            $header['Retry-After'] = $retry;
        }

        return $response->headers->add($header);
    }

    protected function attemptRequestResponse($key, $max)
    {
        $response = new JsonResponse([
            'error' => [
                'code' => Response::HTTP_TOO_MANY_REQUESTS,
                'message' => 'Too many attempt request',
            ],
        ], Response::HTTP_TOO_MANY_REQUESTS);

        $this->attemptRequestLimitHeader($response, $max, $this->attemptRequestCalc($key, $max), $this->rateLimiter->availableIn($key));
    }

    protected function attemptRequestSignature($request)
    {
        return sha1($request->method().'|'.$request->getHost().'|'.$request->ip());
    }
}