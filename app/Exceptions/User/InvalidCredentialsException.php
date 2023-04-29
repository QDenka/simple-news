<?php

namespace App\Exceptions\User;

use Exception;

class InvalidCredentialsException extends Exception
{
    public function __construct()
    {
        parent::__construct('Invalid credentials data');
    }
}
