<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\BudgetItem;
use Illuminate\Support\Carbon;

class StoreExpenseRequest extends FormRequest
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
            'budget_item_id' => ['required', 'integer', Rule::exists('budget_items', 'id')],
            'description' => ['required', 'string', 'max:255'],
            'amount' => [
                'required',
                'numeric',
                'min:0.01',
                'max:9999999999999.99',
            ],
            'transaction_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $budgetItem = BudgetItem::with('budget.fiscalYear')
                        ->find($this->budget_item_id);

                    $fiscalYear = $budgetItem?->budget?->fiscalYear;

                    if (! $fiscalYear) {
                        return;
                    }

                    $date = Carbon::parse($value);
                    $start = Carbon::parse($fiscalYear->start_date);
                    $end = Carbon::parse($fiscalYear->end_date);

                    if ($date->lt($start) || $date->gt($end)) {
                        $fail('The transaction date must fall within the fiscal year period.');
                    }
                },
            ],

        ];
    }

    public function messages(): array
    {
        return [
            'budget_item_id.required' => 'The budget item ID is required.',
            'budget_item_id.integer' => 'The budget item ID must be a valid integer.',
            'budget_item_id.exists' => 'The selected budget item does not exist.',

            'description.required' => 'The expense description is required.',
            'description.string' => 'The expense description must be a valid string.',
            'description.max' => 'The expense description may not exceed 255 characters.',

            'amount.required' => 'The expense amount is required.',
            'amount.numeric' => 'The expense amount must be a number.',
            'amount.min' => 'The expense amount must be greater than zero.',
            'amount.max' => 'The expense amount exceeds the maximum allowed value.',

            'transaction_date.required' => 'The transaction date is required.',
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
                'required' => true,
            ],

            'description' => [
                'description' => 'Brief description of the expense or transaction.',
                'example' => 'Payment for road repair materials',
                'required' => true,
            ],

            'amount' => [
                'description' => 'Amount spent for this expense. Must be greater than zero.',
                'example' => 125000.50,
                'required' => true,
            ],

            'transaction_date' => [
                'description' => 'Date when the expense was incurred. Cannot be a future date.',
                'example' => '2025-03-15',
                'required' => true,
            ],
        ];
    }
}
