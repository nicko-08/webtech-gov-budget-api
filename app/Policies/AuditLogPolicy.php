<?php

namespace App\Policies;

use App\Models\User;

final class AuditLogPolicy
{
    public function viewAny(?User $user): bool
    {
        if (! $user) {
            return false;
        }

        return in_array($user->role, [
            'admin',
            'auditor',
        ], true);
    }

    public function view(?User $user): bool
    {
        return $this->viewAny($user);
    }
}
