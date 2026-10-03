<?php
namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{

    public function register(array $data): string
    {
        $user = User::create([
            'fio' => $data['fio'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'avatar' => $data['avatar'] ?? '/avatars/default.jpg',
            'role' => 'client',
        ]);

        return $user->createToken('api_token')->plainTextToken;
    }


    public function login(array $data): string
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['Login failed'],
            ]);
        }

        $user->tokens()->delete();

        return $user->createToken('api_token')->plainTextToken;
    }
}
