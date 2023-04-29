<?php

namespace App\Http\Requests;

interface DtoRequestContract
{
    /**
     * @return mixed
     */
    public function toDto(): mixed;
}
