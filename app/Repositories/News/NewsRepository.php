<?php

namespace App\Repositories\News;

use App\Models\News\News;
use App\Repositories\Contracts\BaseRepository;
use App\Repositories\Contracts\UserableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class NewsRepository extends BaseRepository implements UserableContract
{
    public function __construct()
    {
        parent::__construct(new News());
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        $createdData = $this->model->create(
            [
                'title' => $data['title'],
                'description' => $data['description'],
                'user_id' => Auth::id(),
            ]
        );
        $createdData->categories()->attach($data['category_ids']);

        return $createdData;
    }

    /**
     * @return bool
     */
    public function delete(): bool
    {
        $this->model = $this->model->withUser();
        return parent::delete();
    }

    public function update(array $data): Model
    {
        $this->withUser();
        $this->model->update([
            'title' => $data['title'],
            'description' => $data['description'],
        ]);
        $this->model->categories()->sync($data['category_ids']);
        return $this->model;
    }

    /**
     * @return void
     */
    public function withUser(): void
    {
        $this->model = $this->model->withUser();
    }
}
