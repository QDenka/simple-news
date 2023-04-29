<?php

namespace App\Repositories\User;

use App\Models\User\User;
use App\Repositories\Contracts\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new User());
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->model->create(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]
        );
    }

    public function update(array $data): Model
    {
        $this->model->update([
            'name' => $data['name'],
        ]);
        return $this->model;
    }
}
