<?php

namespace App\Repositories;

use App\Models\Library as Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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
    public function getForIndexPage($nbPerPage = 15)
    {
        $columns = ['id', 'name', 'address',
            'notes', 'picture_path', 'created_at'];

        return $this->startConditions()
            ->select($columns)
            ->paginate($nbPerPage);
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
            ->orderBy('id', 'desc')
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
     * @param int $libraryId
     * @param int $nbPerPage
     * @return LengthAwarePaginator
     */
    public function getAllRegistrationsInLibrary($libraryId, $nbPerPage = 20)
    {
        $library = Model::find($libraryId);
        $relations = ['user:id,name'];

        return $library
            ->printingRegistrations()
            ->orderBy('id', 'desc')
            ->with($relations)
            ->paginate($nbPerPage);
    }

    /**
     * @param int $libraryId
     * @param int $nbPerPage
     * @return LengthAwarePaginator
     */
    public function getAllWritingOffsInLibrary($libraryId, $nbPerPage = 20)
    {
        $library = Model::find($libraryId);
        $relations = ['user:id,name'];

        return $library
            ->printingWritingOffs()
            ->withTrashedParents()
            ->orderBy('id', 'desc')
            ->with($relations)
            ->paginate($nbPerPage);
    }

    /**
     * @param int $libraryId
     * @param int $nbPerPage
     * @return LengthAwarePaginator
     */
    public function getAllServicesInLibrary($libraryId, $nbPerPage = 20)
    {
        $library = Model::find($libraryId);
        $relations = ['readercard:id,code', 'user:id,name'];

        return $library
            ->libraryServices()
            ->orderBy('id', 'desc')
            ->with($relations)
            ->paginate($nbPerPage);
    }

    /**
     * @param int $libraryId
     * @param int $readercardId
     * @param int $nbPerPage
     * @return LengthAwarePaginator
     */
    public function getServiceGetBackOptions($libraryId, $readercardId = 0, $nbPerPage = 20)
    {
        $library = Model::find($libraryId);
        $relations = ['readercard:id,code', 'user:id,name'];

        if ($readercardId != 0) {
            return $library
                ->libraryServices()
                ->with($relations)
                ->where('readercard_id', $readercardId)
                ->whereNull('returned_at')
                ->paginate($nbPerPage);
        } else {
            return $library
                ->libraryServices()
                ->with($relations)
                ->whereNull('returned_at')
                ->paginate($nbPerPage);
        }
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
