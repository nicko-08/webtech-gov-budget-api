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
