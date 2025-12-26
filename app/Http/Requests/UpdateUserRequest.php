<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user')?->id;
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($userId)],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role' => ['sometimes', 'required', 'string', 'in:admin,budget-officer,auditor,user'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'name' => [
                'description' => 'Updated full name of the user.',
                'example' => 'Maria Santos',
                'required' => false,
            ],

            'email' => [
                'description' => 'Updated unique email address used for login and notifications.',
                'example' => 'maria.santos@gov.ph',
                'required' => false,
            ],

            'password' => [
                'description' => 'New password for the user account. Must meet system security requirements. Leave empty if not changing.',
                'example' => 'NewStrongP@ssw0rd',
                'required' => false,
            ],

            'password_confirmation' => [
                'description' => 'Confirmation of the new password. Must match the password field.',
                'example' => 'NewStrongP@ssw0rd',
                'required' => false,
            ],

            'role' => [
                'description' => 'Updated role assigned to the user, which determines access level and permissions.',
                'example' => 'budget-officer',
                'required' => false,
            ],
        ];
    }
}
