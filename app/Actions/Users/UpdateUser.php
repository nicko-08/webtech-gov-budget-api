<?php

namespace App\Actions\Users;

use App\Models\User;

final class UpdateUser
{
    public function execute(User $user, array $data): User
    {
        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return $user->refresh();
    }
}
