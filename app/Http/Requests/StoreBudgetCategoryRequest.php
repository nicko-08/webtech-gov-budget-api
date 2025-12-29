<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBudgetCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:budget_categories,name',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The budget category name is required.',
            'name.string' => 'The budget category name must be a valid string.',
            'name.max' => 'The budget category name may not exceed 255 characters.',
            'name.unique' => 'This budget category already exists.',
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'name' => [
                'description' => 'Budget Category Name',
                'example' => 'Office Supplies',
                'required' => true,
            ],
        ];
    }
}
