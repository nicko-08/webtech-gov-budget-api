<?php

namespace App\Policies;

use App\Models\BudgetItem;
use App\Models\User;

class BudgetItemPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, BudgetItem $budgetItem): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'budget-officer'], true);
    }

    public function update(User $user, BudgetItem $budgetItem): bool
    {
        return in_array($user->role, ['admin', 'budget-officer'], true);
    }

    public function delete(User $user, BudgetItem $budgetItem): bool
    {
        return in_array($user->role, ['admin', 'budget-officer'], true);
    }
}
