<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBudgetItemRequest extends FormRequest
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
        /** @var BudgetItem $budgetItem */
        $budgetItem = $this->route('budget_item');

        return [
            'budget_id' => ['sometimes', 'required', 'integer', Rule::exists('budgets', 'id')],
            'budget_category_id' => ['sometimes', 'required', 'integer', Rule::exists('budget_categories', 'id')],
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'code' => ['sometimes', 'required', 'string', 'max:50', Rule::unique('budget_items', 'code')->ignore($budgetItem)],
            'allocated_amount' => ['sometimes', 'required', 'numeric', 'min:0'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'budget_id' => [
                'description' => 'ID of the parent budget to which this budget item belongs.',
                'example' => 1,
                'required' => false,
            ],

            'budget_category_id' => [
                'description' => 'ID of the budget category used to classify this budget item.',
                'example' => 3,
                'required' => false,
            ],

            'name' => [
                'description' => 'Updated name of the budget item.',
                'example' => 'Road and Bridge Rehabilitation',
                'required' => false,
            ],

            'code' => [
                'description' => 'Updated unique reference code for the budget item.',
                'example' => 'INFRA-RBR-002',
                'required' => false,
            ],

            'allocated_amount' => [
                'description' => 'Updated allocated amount for this budget item. Must be a non-negative number.',
                'example' => 3000000.00,
                'required' => false,
            ],
        ];
    }
}
