<?php

namespace App\Repositories;

use App\Models\Post as Model;
use Storage;

class PostRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @param int $count
     * @return mixed
     */
    public function getForMainPage($count)
    {
        $columns = ['id', 'user_id', 'title',
            'is_published', 'published_at', 'description', 'picture_path'];
        $relations = ['user:id,name'];

        return $this->startConditions()
            ->select($columns)
            ->with($relations)
            ->where('is_published', 1)
            ->orderBy('published_at', 'desc')
            ->take($count)
            ->get();
    }

    /**
     * @param int $nbPerPage
     * @param bool $withTrashed
     * @return mixed
     */
    public function getAllWithPagination($nbPerPage = 15, $withTrashed = false)
    {
        $columns = ['id', 'user_id', 'title',
            'is_published', 'published_at', 'updated_at'];
        $relations = ['user:id,name'];

        return $this->startConditions()
            ->select($columns)
            ->with($relations)
            ->orderBy('updated_at', 'desc')
            ->withTrashed($withTrashed)
            ->paginate($nbPerPage);
    }

    /**
     * @param int $id
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    /**
     * @param array $requestData
     * @return array
     */
    public function saveModel($requestData)
    {
        $model = $this->startConditions();

        if (!empty($requestData['picture'])) {
            $newPath = Storage::disk('public')
                ->putFile('/images/posts', $requestData['picture']);
            $requestData['picture_path'] = $newPath;
        }

        return [
            'succeed' => $model->fill($requestData)->save(),
            'id' => $model->id,
        ];
    }

    /**
     * @param Model $model
     * @param array $requestData
     * @return bool
     */
    public function updateModel(Model $model, $requestData)
    {
        if (!empty($requestData['picture'])) {
            $newPath = Storage::disk('public')
                ->putFile('/images/posts', $requestData['picture']);
            $oldPath = $model->picture_path;
            if (!empty($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
            $requestData['picture_path'] = $newPath;
        }

        return $model->fill($requestData)->update();
    }
}
