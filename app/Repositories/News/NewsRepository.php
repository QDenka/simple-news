<?php

namespace App\Repositories\News;

use App\Exceptions\User\NoAccessToNewsException;
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
                'content' => $data['content'],
                'user_id' => Auth::id(),
            ]
        );

        // @phpstan-ignore-next-line
        $createdData->categories()->attach($data['category_ids']);

        return $createdData;
    }

    /**
     * @return bool
     * @throws NoAccessToNewsException
     */
    public function delete(): bool
    {
        $this->checkUser();

        return parent::delete();
    }

    /**
     * @param array $data
     * @return Model
     * @throws NoAccessToNewsException
     */
    public function update(array $data): Model
    {
        $this->checkUser();
        $this->model->update([
            'title' => $data['title'],
            'content' => $data['content'],
        ]);

        // @phpstan-ignore-next-line
        $this->model->categories()->sync($data['category_ids']);

        return $this->model;
    }

    /**
     * @return void
     * @throws NoAccessToNewsException
     */
    public function checkUser(): void
    {
        // @phpstan-ignore-next-line
        if ($this->model->user_id != Auth::id()) {
            throw new NoAccessToNewsException();
        }
    }
}
