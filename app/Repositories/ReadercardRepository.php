<?php

namespace App\Repositories;

use App\Models\Readercard as Model;

class ReadercardRepository extends CoreRepository
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
        $columns = ['id', 'code', 'created_at', 'updated_at'];

        return $this->startConditions()
            ->select($columns)
            ->withTrashed($withTrashed)
            ->paginate($nbPerPage);
    }

    /**
     * @param int $id
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()
            ->find($id);
    }

    public function getSelectOptions($excludingId = 0)
    {
        $columns = ['id', 'code'];

        return $this->startConditions()
            ->where('id', '!=', $excludingId)
            ->toBase()
            ->get($columns);
    }
}
