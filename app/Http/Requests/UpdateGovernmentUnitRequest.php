<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGovernmentUnitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'type' => ['sometimes', 'required', 'string', 'max:100'],
            'parent_id' => ['nullable', 'integer', Rule::exists('government_units', 'id')],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The government unit name is required when provided.',
            'name.string' => 'The government unit name must be a valid string.',
            'name.max' => 'The government unit name may not exceed 255 characters.',

            'type.required' => 'The government unit type is required when provided.',
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
                'description' => 'Updated official name of the government unit.',
                'example' => 'Department of Transportation',
                'required' => false,
            ],

            'type' => [
                'description' => 'Updated type or classification of the government unit.',
                'example' => 'Department',
                'required' => false,
            ],

            'parent_id' => [
                'description' => 'ID of the parent government unit, if this unit is part of a hierarchical structure. Can be null.',
                'example' => 1,
                'required' => false,
            ],
        ];
    }
}
