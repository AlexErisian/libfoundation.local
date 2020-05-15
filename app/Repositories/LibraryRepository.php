<?php

namespace App\Repositories;

use App\Models\Library as Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Storage;

class LibraryRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @param int $nbPerPage
     * @param bool $withTrashed
     * @return LengthAwarePaginator
     */
    public function getAllWithPagination($nbPerPage = 15, $withTrashed = false)
    {
        $columns = ['id', 'name', 'address'];

        return $this->startConditions()
            ->select($columns)
            ->withTrashed($withTrashed)
            ->paginate($nbPerPage);
    }

    /**
     * @param int $excludingId
     * @return Collection
     */
    public function getSelectOptions($excludingId = 0)
    {
        $columns = ['id', 'name'];

        return $this->startConditions()
            ->where('id', '!=', $excludingId)
            ->orderBy('name')
            ->toBase()
            ->get($columns);
    }

    /**
     * @param int $id
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    public function saveModel($requestData)
    {
        $model = $this->startConditions();

        if (!empty($requestData['picture'])) {
            $newPath = Storage::disk('public')
                ->putFile('/images/libraries', $requestData['picture']);
            $requestData['picture_path'] = $newPath;
        }

        return [
            'succeed' => $model->fill($requestData)->save(),
            'id' => $model->id,
        ];
    }

    public function updateModel($model, $requestData)
    {
        if (!empty($requestData['picture'])) {
            $newPath = Storage::disk('public')
                ->putFile('/images/libraries', $requestData['picture']);
            $oldPath = $model->picture_path;
            if (!empty($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
            $requestData['picture_path'] = $newPath;
        }

        return $model->fill($requestData)->update();
    }
}
