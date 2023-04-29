<?php

namespace App\Services\User\Contracts;

use App\DataTransferObjects\User\RegisterDto;

interface RegisterContract
{
    /**
     * @param RegisterDto $registerData
     * @return bool|string
     */
    public function register(RegisterDto $registerData): bool|string;
}
