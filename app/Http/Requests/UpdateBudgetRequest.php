<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBudgetRequest extends FormRequest
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
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'government_unit_id' => ['sometimes', 'required', 'integer', Rule::exists('government_units', 'id')],
            'fiscal_year_id' => ['sometimes', 'required', 'integer', Rule::exists('fiscal_years', 'id')],
            'total_amount' => ['sometimes', 'required', 'numeric', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The budget name is required when provided.',
            'name.string' => 'The budget name must be a valid string.',
            'name.max' => 'The budget name may not exceed 255 characters.',

            'government_unit_id.required' => 'The government unit ID is required when provided.',
            'government_unit_id.integer' => 'The government unit ID must be a valid integer.',
            'government_unit_id.exists' => 'The selected government unit does not exist.',

            'fiscal_year_id.required' => 'The fiscal year ID is required when provided.',
            'fiscal_year_id.integer' => 'The fiscal year ID must be a valid integer.',
            'fiscal_year_id.exists' => 'The selected fiscal year does not exist.',

            'total_amount.required' => 'The total budget amount is required when provided.',
            'total_amount.numeric' => 'The total budget amount must be a number.',
            'total_amount.min' => 'The total budget amount must be zero or greater.',
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'name' => [
                'description' => 'Updated official name of the budget.',
                'example' => 'Revised Infrastructure Budget 2025',
                'required' => false,
            ],

            'government_unit_id' => [
                'description' => 'Updated ID of the government unit responsible for this budget.',
                'example' => 1,
                'required' => false,
            ],

            'fiscal_year_id' => [
                'description' => 'Updated ID of the fiscal year to which this budget applies.',
                'example' => 1,
                'required' => false,
            ],

            'total_amount' => [
                'description' => 'Updated total approved amount for the budget. Must be a non-negative number.',
                'example' => 175000000.00,
                'required' => false,
            ],
        ];
    }
}
