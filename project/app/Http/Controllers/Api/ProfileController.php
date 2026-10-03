<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\UserService;
use App\Actions\User\UpdateUserAction;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function update(UpdateProfileRequest $request, UpdateUserAction $action): JsonResponse
    {
        $this->userService->updateProfile($request->user(), $request->validated(), $action);

        return response()->json([
            'message' => 'data updated successfully'
        ], 200);
    }
}
