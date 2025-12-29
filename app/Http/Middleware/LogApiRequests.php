<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogApiRequests
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only log failed requests and auth attempts
        if ($response->getStatusCode() >= 400 || $this->isAuthEndpoint($request)) {
            $this->logRequest($request, $response);
        }

        return $response;
    }

    private function logRequest(Request $request, Response $response): void
    {
        $statusCode = $response->getStatusCode();
        $logLevel = match (true) {
            $statusCode >= 500 => 'error',
            $statusCode >= 400 => 'warning',
            default => 'info'
        };

        Log::log($logLevel, 'api.request', [
            'method' => $request->method(),
            'url' => $request->url(),
            'route' => $request->route()?->getName(),
            'status' => $statusCode,
            'user_id' => $request->user()?->id,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }

    private function isAuthEndpoint(Request $request): bool
    {
        return str_starts_with(
            (string) $request->route()?->getName(),
            'api.v1.'
        ) && in_array($request->route()?->getName(), [
            'api.v1.login',
            'api.v1.logout',
        ], true);
    }
}
