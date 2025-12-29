<?php

namespace App\Policies;

use App\Models\Budget;
use App\Models\User;

final class BudgetPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Budget $budget): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'budget-officer'], true);
    }

    public function update(User $user, Budget $budget): bool
    {
        return in_array($user->role, ['admin', 'budget-officer'], true);
    }

    public function delete(User $user, Budget $budget): bool
    {
        return in_array($user->role, ['admin', 'budget-officer'], true);
    }
}
