<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    public function __construct(
        protected Model $model
    ) {
    }

    /**
     * @param Model $model
     * @return self
     */
    public function initByModel(Model $model): self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @return Model
     */
    public function get(): Model
    {
        return $this->model->get();
    }

    /**
     * @return bool
     */
    public function delete(): bool
    {
        return $this->model->delete();
    }

    abstract public function create(array $data): Model;
    abstract public function update(array $data): Model;
}
