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

        Log::log($logLevel, 'API Request', [
            'method' => $request->method(),
            'url' => $request->url(),
            'route' => $request->route()?->getName(),
            'status' => $statusCode,
            'user_id' => $request->user()?->id,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);
    }

    private function isAuthEndpoint(Request $request): bool
    {
        return str_contains($request->path(), 'login') ||
            str_contains($request->path(), 'register') ||
            str_contains($request->path(), 'logout');
    }
}
