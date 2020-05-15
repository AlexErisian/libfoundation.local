<?php

namespace App\Repositories;

use App\Models\Printing as Model;
use Illuminate\Support\Collection;
use Storage;

class PrintingRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @param int $nbPerPage
     * @param bool $withTrashed
     * @return mixed
     */
    public function getAllWithPagination($nbPerPage = 15, $withTrashed = false)
    {
        $columns = [
            'id', 'printing_author_id', 'printing_pubhouse_id', 'printing_type_id',
            'title', 'publication_year', 'isbn'];
        $relations = [
            'author:id,name',
            'pubhouse:id,name',
            'type:id,name',];

        return $this->startConditions()
            ->select($columns)
            ->with($relations)
            ->orderBy('id', 'desc')
            ->withTrashed($withTrashed)
            ->paginate($nbPerPage);
    }

    /**
     * @param int $excludingId
     * @return Collection
     */
    public function getSelectOptions($excludingId = 0)
    {
        $columns = ['id', 'title'];

        return $this->startConditions()
            ->where('id', '!=', $excludingId)
            ->orderBy('title')
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

    /**
     * @param array $requestData
     * @return array
     */
    public function saveModel($requestData)
    {
        $model = $this->startConditions();

        if (!empty($requestData['picture'])) {
            $newPath = Storage::disk('public')
                ->putFile('/images/printings', $requestData['picture']);
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
        $model->genres()->sync($requestData['genre_ids']);

        if (!empty($requestData['picture'])) {
            $newPath = Storage::disk('public')
                ->putFile('/images/printings', $requestData['picture']);
            $oldPath = $model->picture_path;
            if (!empty($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
            $requestData['picture_path'] = $newPath;
        }

        return $model->fill($requestData)->update();
    }
}
