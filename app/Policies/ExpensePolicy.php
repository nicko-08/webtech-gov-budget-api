<?php

namespace App\Policies;

use App\Models\Expense;
use App\Models\User;

final class ExpensePolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Expense $expense): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'budget-officer'], true);
    }

    public function update(User $user, Expense $expense): bool
    {
        return in_array($user->role, ['admin', 'budget-officer'], true);
    }

    public function delete(User $user, Expense $expense): bool
    {
        return in_array($user->role, ['admin', 'budget-officer'], true);
    }
}
