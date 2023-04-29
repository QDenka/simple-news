<?php

namespace App\Services\User;

use App\DataTransferObjects\User\RegisterDto;
use App\Repositories\User\UserRepository;
use App\Services\User\Contracts\CreateUserContract;
use App\Services\User\Contracts\RegisterContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class RegisterService implements RegisterContract, CreateUserContract
{
    protected RegisterDto $registerData;

    /**
     * @param RegisterDto $registerData
     * @return bool|string
     * @throws \Throwable
     */
    public function register(RegisterDto $registerData): bool|string
    {
        $this->registerData = $registerData;
        $this->createUser();

        return app(AuthenticateService::class)->authenticate(
            $this->registerData->getEmail(),
            $this->registerData->getPassword(),
        );
    }

    /**
     * @return Model
     * @throws \Throwable
     */
    public function createUser(): Model
    {
        return (new UserRepository)->create(
            [
                'name' => $this->registerData->getName(),
                'email' => $this->registerData->getEmail(),
                'password' => Hash::make($this->registerData->getPassword()),
            ]
        );
    }
}
