<?php
namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class RegisterUserAction
{
    public function execute(array $data): array
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'fio' => $data['fio'],
                'email' => $data['email'],
                'password' => $data['password'],
                'avatar' => $data['avatar'] ?? '/avatars/default.jpg',
                'role' => 'client',
            ]);

            $token = $user->createToken('api_token')->plainTextToken;

            return [
                'user' => $user,
                'token' => $token,
            ];
        });
    }
}
