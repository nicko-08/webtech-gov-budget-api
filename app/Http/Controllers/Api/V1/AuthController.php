<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Auth\AuthenticateUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Authentication
 * User authentication endpoints
 */
final class AuthController extends Controller
{
    public function __construct(
        private readonly AuthenticateUser $authenticateUser
    ) {}

    /**
     * Login user
     *
     * @unauthenticated
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $user = $this->authenticateUser->execute($request->validated());

        return response()->json([
            'user' => new UserResource($user),
            'token' => $user->createToken('api-token')->plainTextToken,
        ], Response::HTTP_OK);
    }

    /**
     * Logout user
     *
     * @authenticated
     */
    public function logout(Request $request): Response
    {
        $request->user()
            ?->currentAccessToken()
            ?->delete();

        return response()->noContent();
    }
}
