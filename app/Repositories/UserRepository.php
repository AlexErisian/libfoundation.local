<?php

namespace App\Repositories;

use App\Models\User as Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserRepository extends BaseRepository
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
        $columns = ['id', 'role_id', 'readercard_id', 'name', 'is_banned'];
        $relations = ['role:id,name', 'readercard:id,code'];

        return $this->startConditions()
            ->select($columns)
            ->with($relations)
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
     * @return \Illuminate\Database\Eloquent\Model|Model
     */
    public function getEdit($id)
    {
        $withRelations = ['role:id,name', 'readercard:id,code'];

        return $this->startConditions()
            ->with($withRelations)
            ->find($id);
    }

    /**
     * @param array $requestData
     * @return array
     */
    public function saveModel($requestData)
    {
        $model = $this->startConditions();

        $requestData['password'] = bcrypt($requestData['password']);

        $succeed = $model
            ->fill($requestData)
            ->save();

        return [
            'succeed' => $succeed,
            'id' => $model->id
        ];
    }
}
