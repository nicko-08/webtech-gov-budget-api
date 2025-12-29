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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:admin,budget-officer,auditor,user'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The user name is required.',
            'name.string' => 'The user name must be a valid string.',
            'name.max' => 'The user name may not exceed 255 characters.',

            'email.required' => 'The email address is required.',
            'email.string' => 'The email address must be a valid string.',
            'email.email' => 'The email address must be a valid email format.',
            'email.lowercase' => 'The email address must be in lowercase.',
            'email.max' => 'The email address may not exceed 255 characters.',
            'email.unique' => 'This email address is already registered.',

            'password.required' => 'The password is required.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password.min' => 'The password does not meet the minimum security requirements.',

            'role.required' => 'The user role is required.',
            'role.string' => 'The user role must be a valid string.',
            'role.in' => 'The selected user role is invalid.',
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
                'description' => 'Unique email address.',
                'example' => 'juan.delacruz@gov.ph',
                'required' => true,
            ],

            'password' => [
                'description' => 'Account Password.',
                'example' => 'StrongP@ssw0rd',
                'required' => true,
            ],

            'password_confirmation' => [
                'description' => 'Must match the password.',
                'example' => 'StrongP@ssw0rd',
                'required' => true,
            ],

            'role' => [
                'description' => 'User Role.',
                'example' => 'budget-officer',
                'required' => true,
            ],
        ];
    }
}
