<?php

namespace App\Services\User\Contracts;

interface LogoutContract
{
    /**
     * @return void
     */
    public function logout(): void;
}
