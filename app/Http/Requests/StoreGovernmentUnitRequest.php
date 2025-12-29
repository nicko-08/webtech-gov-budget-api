<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGovernmentUnitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:100'],
            'parent_id' => ['nullable', 'integer', Rule::exists('government_units', 'id')],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The government unit name is required.',
            'name.string' => 'The government unit name must be a valid string.',
            'name.max' => 'The government unit name may not exceed 255 characters.',

            'type.required' => 'The government unit type is required.',
            'type.string' => 'The government unit type must be a valid string.',
            'type.max' => 'The government unit type may not exceed 100 characters.',

            'parent_id.integer' => 'The parent government unit ID must be a valid integer.',
            'parent_id.exists' => 'The selected parent government unit does not exist.',
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'name' => [
                'description' => 'Official name of the government unit.',
                'example' => 'Department of Public Works and Highways',
                'required' => true,
            ],

            'type' => [
                'description' => 'Type or classification of the government unit.',
                'example' => 'Department',
                'required' => true,
            ],

            'parent_id' => [
                'description' => 'ID of the parent government unit, if this unit is part of a hierarchical structure.',
                'example' => 1,
                'required' => false,
            ],
        ];
    }
}
