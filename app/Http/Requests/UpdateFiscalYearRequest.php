<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFiscalYearRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $fiscalYearId = $this->route('fiscal_year')?->id;

        return [
            'year' => ['sometimes', 'required', 'integer', Rule::unique('fiscal_years', 'year')->ignore($fiscalYearId), 'min:1900'],
            'start_date' => ['sometimes', 'required', 'date'],
            'end_date' => ['sometimes', 'required', 'date', 'after:start_date'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'year.required' => 'The fiscal year is required when provided.',
            'year.integer' => 'The fiscal year must be a valid year number.',
            'year.unique' => 'This fiscal year already exists.',
            'year.min' => 'The fiscal year must be 1900 or later.',

            'start_date.required' => 'The start date is required when provided.',
            'start_date.date' => 'The start date must be a valid date.',

            'end_date.required' => 'The end date is required when provided.',
            'end_date.date' => 'The end date must be a valid date.',
            'end_date.after' => 'The end date must be after the start date.',

            'is_active.boolean' => 'The active flag must be true or false.',
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'year' => [
                'description' => 'Updated fiscal year as a four-digit calendar year. Must be unique.',
                'example' => 2025,
                'required' => false,
            ],

            'start_date' => [
                'description' => 'Updated start date of the fiscal year.',
                'example' => '2025-01-01',
                'required' => false,
            ],

            'end_date' => [
                'description' => 'Updated end date of the fiscal year. Must be after the start date.',
                'example' => '2025-12-31',
                'required' => false,
            ],

            'is_active' => [
                'description' => 'Indicates whether this fiscal year is currently active.',
                'example' => true,
                'required' => false,
            ],
        ];
    }
}
