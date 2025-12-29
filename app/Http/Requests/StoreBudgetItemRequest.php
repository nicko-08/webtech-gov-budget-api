<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBudgetItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'budget_id' => ['required', 'integer', Rule::exists('budgets', 'id')],
            'budget_category_id' => ['required', 'integer', Rule::exists('budget_categories', 'id')],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', Rule::unique('budget_items', 'code')],
            'allocated_amount' => [
                'required',
                'numeric',
                'min:0',
                'max:9999999999999.99'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'budget_id.required' => 'The budget ID is required.',
            'budget_id.integer' => 'The budget ID must be a valid integer.',
            'budget_id.exists' => 'The selected budget does not exist.',

            'budget_category_id.required' => 'The budget category ID is required.',
            'budget_category_id.integer' => 'The budget category ID must be a valid integer.',
            'budget_category_id.exists' => 'The selected budget category does not exist.',

            'name.required' => 'The budget item name is required.',
            'name.string' => 'The budget item name must be a valid string.',
            'name.max' => 'The budget item name may not exceed 255 characters.',

            'code.required' => 'The budget item code is required.',
            'code.string' => 'The budget item code must be a valid string.',
            'code.max' => 'The budget item code may not exceed 50 characters.',
            'code.unique' => 'This budget item code is already in use.',

            'allocated_amount.required' => 'The allocated amount is required.',
            'allocated_amount.numeric' => 'The allocated amount must be a number.',
            'allocated_amount.min' => 'The allocated amount must be zero or greater.',
            'allocated_amount.max' => 'The allocated amount exceeds the maximum allowed value.',
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'budget_id' => [
                'description' => 'ID of the parent budget to which this budget item belongs.',
                'example' => 1,
                'required' => true,
            ],

            'budget_category_id' => [
                'description' => 'ID of the budget category used to classify this budget item.',
                'example' => 3,
                'required' => true,
            ],

            'name' => [
                'description' => 'Human-readable name of the budget item.',
                'example' => 'Road and Bridge Maintenance',
                'required' => true,
            ],

            'code' => [
                'description' => 'Unique reference code for the budget item, used for tracking and reporting.',
                'example' => 'INFRA-RBM-001',
                'required' => true,
            ],

            'allocated_amount' => [
                'description' => 'Total amount allocated to this budget item. Must be a non-negative number.',
                'example' => 2500000.00,
                'required' => true,
            ],
        ];
    }
}
