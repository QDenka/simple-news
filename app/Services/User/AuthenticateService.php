<?php

namespace App\Services\User;

use App\DataTransferObjects\User\AuthenticateDto;
use App\Exceptions\User\InvalidCredentialsException;
use App\Services\User\Contracts\AuthenticateContract;
use App\Services\User\Contracts\LogoutContract;
use Illuminate\Support\Facades\Auth;

class AuthenticateService implements AuthenticateContract, LogoutContract
{
    /**
     * @param AuthenticateDto $authData
     * @return string
     * @throws InvalidCredentialsException
     */
    public function attempt(AuthenticateDto $authData): string
    {
        $token = $this->authenticate(
            $authData->getEmail(),
            $authData->getPassword(),
        );

        if ($token === false) {
            throw new InvalidCredentialsException();
        }

        return $token;
    }

    /**
     * @param string $email
     * @param string $password
     * @return string|bool
     */
    public function authenticate(string $email, string $password): string|bool
    {
        return Auth::attempt([
            'email' => $email,
            'password' => $password,
        ]);
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        Auth::logout();
    }
}
