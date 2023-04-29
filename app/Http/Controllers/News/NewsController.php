<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\NewsStoreRequest;
use App\Models\News\News;
use App\Repositories\News\NewsRepository;

class NewsController extends Controller
{
    public function __construct(protected NewsRepository $repository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->success(
            $this->repository->get()->toArray(),
        );
    }

    /**
     * @param NewsStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(NewsStoreRequest $request)
    {
        $news = $this->repository->create($request->toArray());

        return $this->success($news->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsStoreRequest $request, News $news)
    {
        $news = $this->repository
            ->initByModel($news)
            ->update($request->toArray(), $news);

        return $this->success($news->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $this->repository
            ->initByModel($news)
            ->delete();

        return $this->success([
            'message' => 'News deleted successfully',
        ]);
    }
}
