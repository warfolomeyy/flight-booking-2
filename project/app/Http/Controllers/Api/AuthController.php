<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use App\Services\AuthService;
use App\Actions\Auth\RegisterUserAction;
use App\Actions\Auth\LoginUserAction;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function signup(Request $request, RegisterUserAction $action): JsonResponse
    {
        $data = $request->validate([
            'fio' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'avatar' => 'nullable|string',
        ]);

        $result = $this->authService->register($data, $action);

        return response()->json([
            'user_token' => $result['token']
        ], 201);
    }

    public function login(Request $request, LoginUserAction $action): JsonResponse
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $result = $this->authService->login($data, $action);

        return response()->json([
            'user_token' => $result['token']
        ], 200);
    }

    public function profile(Request $request): JsonResponse
    {
        return response()->json([
            'user' => new UserResource($request->user())
        ], 200);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'logout'
        ], 200);
    }

}
