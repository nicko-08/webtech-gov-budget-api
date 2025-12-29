<?php

namespace App\Policies;

use App\Models\FiscalYear;
use App\Models\User;

class FiscalYearPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function view(User $user, FiscalYear $fiscalYear): bool
    {
        return $user->role === 'admin';
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, FiscalYear $fiscalYear): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, FiscalYear $fiscalYear): bool
    {
        return $user->role === 'admin';
    }
}
