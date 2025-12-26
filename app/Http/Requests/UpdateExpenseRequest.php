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
