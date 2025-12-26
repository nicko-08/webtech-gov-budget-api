<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * @group Users
 * User management endpoints
 */
class UserController extends Controller
{
    use ApiResponse;

    /**
     * List users
     * 
     * @authenticated
     */
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(User::latest()->paginate(20));
    }

    /**
     * Create user
     * 
     * @authenticated
     * @bodyParam name string required User's full name. Example: Jane Doe
     * @bodyParam email string required User's email. Example: jane@example.com
     * @bodyParam password string required Password. Example: password123
     * @bodyParam password_confirmation string required Confirm password. Example: password123
     * @bodyParam role string required User role. Example: admin
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        return $this->resourceResponse(new UserResource($user), 'User created successfully', 201);
    }

    /**
     * Show user
     * 
     * @authenticated
     */
    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    /**
     * Update user
     * 
     * @authenticated
     * @bodyParam name string User's full name. Example: Jane Doe
     * @bodyParam email string User's email. Example: jane@example.com
     * @bodyParam password string Password. Example: password123
     * @bodyParam password_confirmation string Confirm password (required if password is provided). Example: password123
     * @bodyParam role string User role. Example: admin
     * @response 200 {
     *   "success": true,
     *   "message": "User updated successfully",
     *   "data": {
     *     "id": 1,
     *     "name": "Jane Doe",
     *     "email": "jane@example.com",
     *     "role": "admin"
     *   }
     * }
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $validated = $request->validated();
        if (isset($validated['password']) && !empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }
        $user->update($validated);

        return $this->resourceResponse(new UserResource($user->fresh()), 'User updated successfully');
    }

    /**
     * Delete user
     * 
     * @authenticated
     */
    public function destroy(User $user): JsonResponse
    {
        // Check if trying to delete own account (only if user is authenticated)
        if (Auth::check() && $user->id === Auth::id()) {
            return $this->error('You cannot delete your own account.', 403);
        }

        $user->delete();

        return $this->success(null, 'User deleted successfully', 200);
    }
}
