<?php

namespace App\Services\User\Contracts;

use Illuminate\Database\Eloquent\Model;

interface CreateUserContract
{
    /**
     * @return Model
     */
    public function createUser(): Model;
}
