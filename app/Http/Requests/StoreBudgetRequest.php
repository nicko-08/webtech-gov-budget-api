<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBudgetRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'government_unit_id' => ['required', 'integer', Rule::exists('government_units', 'id')],
            'fiscal_year_id' => ['required', 'integer', Rule::exists('fiscal_years', 'id')],
            'total_amount' => [
                'required',
                'numeric',
                'min:0',
                'max:9999999999999.99',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The budget name is required.',
            'name.string' => 'The budget name must be a valid string.',
            'name.max' => 'The budget name may not exceed 255 characters.',

            'government_unit_id.required' => 'The government unit ID is required.',
            'government_unit_id.integer' => 'The government unit ID must be a valid integer.',
            'government_unit_id.exists' => 'The selected government unit does not exist.',

            'fiscal_year_id.required' => 'The fiscal year ID is required.',
            'fiscal_year_id.integer' => 'The fiscal year ID must be a valid integer.',
            'fiscal_year_id.exists' => 'The selected fiscal year does not exist.',

            'total_amount.required' => 'The total budget amount is required.',
            'total_amount.numeric' => 'The total budget amount must be a number.',
            'total_amount.min' => 'The total budget amount must be zero or greater.',
            'total_amount.max' => 'The total budget amount exceeds the maximum allowed value.',
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'name' => [
                'description' => 'Official name of the budget.',
                'example' => 'Annual Infrastructure Budget 2025',
                'required' => true,
            ],

            'government_unit_id' => [
                'description' => 'ID of the government unit responsible for this budget.',
                'example' => 2,
                'required' => true,
            ],

            'fiscal_year_id' => [
                'description' => 'ID of the fiscal year to which this budget applies.',
                'example' => 2025,
                'required' => true,
            ],

            'total_amount' => [
                'description' => 'Total approved amount for the budget. Must be a non-negative number.',
                'example' => 150000000.00,
                'required' => true,
            ],
        ];
    }
}
