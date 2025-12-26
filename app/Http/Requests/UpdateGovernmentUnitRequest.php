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
