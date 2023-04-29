<?php

namespace App\DataTransferObjects\User;

class AuthenticateDto
{
    /**
     * @param string $email
     * @param string $password
     */
    public function __construct(
        protected string $email,
        protected string $password,
    ) {
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
