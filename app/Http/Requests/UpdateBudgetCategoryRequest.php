<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBudgetCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('budget_categories', 'name')
                    ->ignore($this->route('budget_category')),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The budget category name is required when provided.',
            'name.string' => 'The budget category name must be a valid string.',
            'name.max' => 'The budget category name may not exceed 255 characters.',
            'name.unique' => 'This budget category name already exists.',
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'name' => [
                'description' => 'Updated name of the budget category.',
                'example' => 'Office Equipment',
                'required' => false,
            ],
        ];
    }
}
