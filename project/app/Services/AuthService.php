<?php
namespace App\Services;

use App\Actions\Auth\RegisterUserAction;
use App\Actions\Auth\LoginUserAction;

class AuthService
{
    public function register(array $data, RegisterUserAction $action): array
    {
        return $action->execute($data);
    }

    public function login(array $data, LoginUserAction $action): array
    {
        return $action->execute($data);
    }
}
