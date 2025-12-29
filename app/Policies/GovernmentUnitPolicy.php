<?php

namespace App\Policies;

use App\Models\GovernmentUnit;
use App\Models\User;

final class GovernmentUnitPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, GovernmentUnit $governmentUnit): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, GovernmentUnit $governmentUnit): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, GovernmentUnit $governmentUnit): bool
    {
        return $user->role === 'admin';
    }
}
