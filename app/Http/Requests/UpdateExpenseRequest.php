<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateExpenseRequest extends FormRequest
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
            'budget_item_id' => ['sometimes', 'required', 'integer', Rule::exists('budget_items', 'id')],
            'description' => ['sometimes', 'required', 'string', 'max:255'],
            'amount' => ['sometimes', 'required', 'numeric', 'min:0.01'],
            'transaction_date' => ['sometimes', 'required', 'date', 'before_or_equal:today'],
        ];
    }

    public function messages(): array
    {
        return [
            'budget_item_id.required' => 'The budget item ID is required when provided.',
            'budget_item_id.integer' => 'The budget item ID must be a valid integer.',
            'budget_item_id.exists' => 'The selected budget item does not exist.',

            'description.required' => 'The expense description is required when provided.',
            'description.string' => 'The expense description must be a valid string.',
            'description.max' => 'The expense description may not exceed 255 characters.',

            'amount.required' => 'The expense amount is required when provided.',
            'amount.numeric' => 'The expense amount must be a number.',
            'amount.min' => 'The expense amount must be greater than zero.',

            'transaction_date.required' => 'The transaction date is required when provided.',
            'transaction_date.date' => 'The transaction date must be a valid date.',
            'transaction_date.before_or_equal' => 'The transaction date cannot be in the future.',
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'budget_item_id' => [
                'description' => 'ID of the budget item under which this expense is recorded.',
                'example' => 15,
                'required' => false,
            ],

            'description' => [
                'description' => 'Updated brief description of the expense or transaction.',
                'example' => 'Purchase of office supplies for road maintenance',
                'required' => false,
            ],

            'amount' => [
                'description' => 'Updated amount spent for this expense. Must be greater than zero.',
                'example' => 125000.50,
                'required' => false,
            ],

            'transaction_date' => [
                'description' => 'Updated date when the expense was incurred. Cannot be a future date.',
                'example' => '2025-03-15',
                'required' => false,
            ],
        ];
    }
}
