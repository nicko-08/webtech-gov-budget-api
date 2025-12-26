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
