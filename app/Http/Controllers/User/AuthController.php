<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserAuthenticateRequest;
use App\Services\User\AuthenticateService;

class AuthController extends Controller
{
    /**
     * @param UserAuthenticateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\User\InvalidCredentialsException
     */
    public function login(UserAuthenticateRequest $request)
    {
        $token = app(AuthenticateService::class)->attempt($request->toDto());

        return $this->success([
            'token' => $token,
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        app(AuthenticateService::class)->logout();

        return $this->success([
            'message' => 'Successfully logged out',
        ]);
    }
}
