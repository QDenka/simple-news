<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRegisterRequest;
use App\Services\User\RegisterService;

class RegisterController extends Controller
{
    /**
     * @param UserRegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function register(UserRegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        $token = app(RegisterService::class)->register($request->toDto());

        return $this->success([
            'message' => 'Successfully registered',
            'token' => $token,
        ]);
    }
}
