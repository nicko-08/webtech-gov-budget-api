<?php

namespace App\Actions\Users;

use App\Models\User;

final class CreateUser
{
    public function execute(array $data): User
    {
        return User::create($data);
    }
}
