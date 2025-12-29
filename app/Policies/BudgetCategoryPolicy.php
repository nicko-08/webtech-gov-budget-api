<?php

namespace App\Policies;

use App\Models\BudgetCategory;
use App\Models\User;

class BudgetCategoryPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, BudgetCategory $budgetCategory): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'budget-officer'], true);
    }

    public function update(User $user, BudgetCategory $budgetCategory): bool
    {
        return in_array($user->role, ['admin', 'budget-officer'], true);
    }

    public function delete(User $user, BudgetCategory $budgetCategory): bool
    {
        return $user->role === 'admin';
    }
}
