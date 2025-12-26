<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        if (!$user || !$this->userHasAnyRole($user, $roles)) {
            return response()->json([
                'message' => 'This action is unauthorized.'
            ], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }

    private function userHasAnyRole($user, array $roles): bool
    {
        foreach ($roles as $role) {
            if ($user->role === $role) {
                return true;
            }
        }
        return false;
    }
}
