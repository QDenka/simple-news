<?php

namespace App\Repositories\Contracts;

interface UserableContract
{
    /**
     * @return void
     */
    public function checkUser(): void;
}
