<?php

namespace App\Services\User\Contracts;

use App\DataTransferObjects\User\AuthenticateDto;
use App\Exceptions\User\InvalidCredentialsException;

interface AuthenticateContract
{
    /**
     * @param AuthenticateDto $authData
     * @throws InvalidCredentialsException
     * @return string
     */
    public function attempt(AuthenticateDto $authData): string;

    /**
     * @param string $email
     * @param string $password
     * @return string|bool
     */
    public function authenticate(string $email, string $password): string|bool;
}
