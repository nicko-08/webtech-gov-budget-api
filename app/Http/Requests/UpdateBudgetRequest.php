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
                'example' => 3,
                'required' => false,
            ],

            'fiscal_year_id' => [
                'description' => 'Updated ID of the fiscal year to which this budget applies.',
                'example' => 2025,
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
