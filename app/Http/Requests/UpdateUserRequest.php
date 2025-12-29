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
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => [
                'sometimes',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($userId),
            ],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role' => ['sometimes', 'string', 'in:admin,budget-officer,auditor,user'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'The user name must be a valid string.',
            'name.max' => 'The user name may not exceed 255 characters.',

            'email.string' => 'The email address must be a valid string.',
            'email.email' => 'The email address must be a valid email format.',
            'email.lowercase' => 'The email address must be in lowercase.',
            'email.max' => 'The email address may not exceed 255 characters.',
            'email.unique' => 'This email address is already in use.',

            'password.confirmed' => 'The password confirmation does not match.',
            'password.min' => 'The password does not meet the minimum security requirements.',

            'role.string' => 'The user role must be a valid string.',
            'role.in' => 'The selected user role is invalid.',
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
