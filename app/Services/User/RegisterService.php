<?php

namespace App\Services\User;

use App\DataTransferObjects\User\RegisterDto;
use App\Models\User\User;
use App\Services\User\Contracts\CreateUserContract;
use App\Services\User\Contracts\RegisterContract;

class RegisterService implements RegisterContract, CreateUserContract
{
    protected RegisterDto $registerData;

    /**
     * @param RegisterDto $registerData
     * @return bool|string|void
     * @throws \Throwable
     */
    public function register(RegisterDto $registerData): bool|string
    {
        $this->registerData = $registerData;
        $user = $this->createUser();

        return app(AuthenticateService::class)->authenticate(
            $this->registerData->getEmail(),
            $this->registerData->getPassword(),
        );
    }

    /**
     * @return User
     * @throws \Throwable
     */
    public function createUser(): User
    {
        $user = new User();
        $user->name = $this->registerData->getName();
        $user->email = $this->registerData->getEmail();
        $user->password = $this->registerData->getPassword();
        $user->saveOrFail();

        return $user;
    }
}
