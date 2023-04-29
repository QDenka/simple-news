<?php

namespace App\Services\User\Contracts;

use App\Models\User\User;

interface CreateUserContract
{
    /**
     * @return User
     */
    public function createUser(): User;
}
