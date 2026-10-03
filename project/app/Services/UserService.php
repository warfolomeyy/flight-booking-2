<?php

namespace App\Services;

use App\Actions\User\UpdateUserAction;
use App\Models\User;

class UserService
{
    public function updateProfile(User $user, array $data, UpdateUserAction $action): User
    {
        return $action->execute($user, $data);
    }
}
