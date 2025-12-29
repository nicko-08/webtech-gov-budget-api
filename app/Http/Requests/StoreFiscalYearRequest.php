<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFiscalYearRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'year' => ['required', 'integer', 'unique:fiscal_years,year', 'min:1900'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'year.required' => 'The fiscal year is required.',
            'year.integer' => 'The fiscal year must be a valid year number.',
            'year.unique' => 'This fiscal year already exists.',
            'year.min' => 'The fiscal year must be 1900 or later.',

            'start_date.required' => 'The start date is required.',
            'start_date.date' => 'The start date must be a valid date.',

            'end_date.required' => 'The end date is required.',
            'end_date.date' => 'The end date must be a valid date.',
            'end_date.after' => 'The end date must be after the start date.',

            'is_active.boolean' => 'The active flag must be true or false.',
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'year' => [
                'description' => 'Fiscal year represented as a four-digit calendar year. Must be unique.',
                'example' => 2025,
                'required' => true,
            ],

            'start_date' => [
                'description' => 'Start date of the fiscal year.',
                'example' => '2025-01-01',
                'required' => true,
            ],

            'end_date' => [
                'description' => 'End date of the fiscal year. Must be after the start date.',
                'example' => '2025-12-31',
                'required' => true,
            ],

            'is_active' => [
                'description' => 'Indicates whether this fiscal year is currently active. Defaults to false if not provided.',
                'example' => true,
                'required' => false,
            ],
        ];
    }
}
