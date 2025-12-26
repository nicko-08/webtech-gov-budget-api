<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:admin,budget-officer,auditor,user'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'name' => [
                'description' => 'Full name of the user.',
                'example' => 'Juan Dela Cruz',
                'required' => true,
            ],

            'email' => [
                'description' => 'Unique email address used for user authentication and notifications.',
                'example' => 'juan.delacruz@gov.ph',
                'required' => true,
            ],

            'password' => [
                'description' => 'Password for the user account. Must meet the system’s minimum security requirements.',
                'example' => 'StrongP@ssw0rd',
                'required' => true,
            ],

            'password_confirmation' => [
                'description' => 'Confirmation of the password. Must match the password field.',
                'example' => 'StrongP@ssw0rd',
                'required' => true,
            ],

            'role' => [
                'description' => 'Role assigned to the user, which determines access level and permissions.',
                'example' => 'budget-officer',
                'required' => true,
            ],
        ];
    }
}
