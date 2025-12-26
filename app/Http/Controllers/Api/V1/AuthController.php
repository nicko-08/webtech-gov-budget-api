<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * @group Authentication
 * User authentication endpoints
 */
class AuthController extends Controller
{
    use ApiResponse;

    /**
     * Register a new user
     * 
     * @bodyParam name string required The user's full name. Example: John Doe
     * @bodyParam email string required The user's email address. Example: john@example.com  
     * @bodyParam password string required The user's password. Example: password123
     * @bodyParam password_confirmation string required Password confirmation (must match password). Example: password123
     * 
     * @unauthenticated
     */
    public function register(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
        ]);

        $token = $user->createToken('api-token')->plainTextToken;
        $userData = (new UserResource($user))->resolve();
        $userData['token'] = $token;

        return $this->success($userData, 'User registered successfully', 201);
    }

    /**
     * Login user
     * 
     * @bodyParam email string required User email address. Example: admin@example.com
     * @bodyParam password string required User password. Example: password
     * 
     * @unauthenticated  
     */
    public function login(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Find user by email
        $user = User::where('email', $validated['email'])->first();

        // Check if user exists and password is correct
        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return $this->error('The provided credentials do not match our records.', 401);
        }

        // Create token
        $token = $user->createToken('api-token')->plainTextToken;
        $userData = (new UserResource($user))->resolve();
        $userData['token'] = $token;

        return $this->success($userData, 'Login successful');
    }

    /**
     * Logout user
     * 
     * @authenticated
     */
    public function logout(Request $request): JsonResponse
    {
        $user = $request->user();

        if (!$user) {
            return $this->error('User not authenticated.', 401);
        }

        /** @var PersonalAccessToken|null $token */
        $token = $user->currentAccessToken();

        if ($token) {
            $token->delete();
        }

        return $this->success(null, 'You have been successfully logged out.');
    }
}
