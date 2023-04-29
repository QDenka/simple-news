<?php

namespace App\Exceptions\User;

use Exception;

class NoAccessToNewsException extends Exception
{
    public function __construct()
    {
        parent::__construct('You have no access to this news');
    }

    public function render()
    {
        return response()->json([
            'message' => $this->getMessage(),
        ], 403);
    }
}
