<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

final class AuditLogIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @queryParam user_id integer Filter by the user who performed the action. Example: 1
     * @queryParam resource string Filter by resource type (Expense, BudgetItem). Example: Expense
     * @queryParam action string Filter by action (created, updated, deleted). Example: created
     * @queryParam date date Filter logs for a specific date (YYYY-MM-DD). Example: 2025-12-28
     * @queryParam from date Start date (YYYY-MM-DD). Example: 2025-12-01
     * @queryParam to date End date (YYYY-MM-DD). Example: 2025-12-31
     * @queryParam per_page integer Records per page (1–100). Example: 25
     */
    public function rules(): array
    {
        return [
            'user_id'  => ['nullable', 'integer', 'exists:users,id'],
            'resource' => ['nullable', 'string', 'max:255'],
            'action'   => ['nullable', 'in:created,updated,deleted'],
            'date'     => ['nullable', 'date'],
            'from'     => ['nullable', 'date'],
            'to'       => ['nullable', 'date', 'after_or_equal:from'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ];
    }

    /**
     * Explicit body schema for Scribe (documentation-driven).
     * This prevents Scribe from inferring noisy inputs.
     */
    public function bodyParameters(): array
    {
        return [
            'user_id' => [
                'description' => 'Filter logs by the user who performed the action.',
                'example' => 1,
                'required' => false,
            ],

            'resource' => [
                'description' => 'Filter by audited resource type.',
                'example' => 'Expense',
                'required' => false,
            ],

            'action' => [
                'description' => 'Filter by action type.',
                'example' => 'created',
                'required' => false,
            ],

            'date' => [
                'description' => 'Filter logs for a specific date (YYYY-MM-DD).',
                'example' => '2025-12-28',
                'required' => false,
            ],

            'from' => [
                'description' => 'Start date for date range filtering (YYYY-MM-DD).',
                'example' => '2025-12-01',
                'required' => false,
            ],

            'to' => [
                'description' => 'End date for date range filtering (YYYY-MM-DD).',
                'example' => '2025-12-31',
                'required' => false,
            ],

            'per_page' => [
                'description' => 'Number of records per page (1–100).',
                'example' => 25,
                'required' => false,
            ],
        ];
    }

    /**
     * Enforce date XOR from/to
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            if ($this->filled('date') && ($this->filled('from') || $this->filled('to'))) {
                $validator->errors()->add(
                    'date',
                    'The date parameter cannot be combined with from or to.'
                );
            }
        });
    }
}
