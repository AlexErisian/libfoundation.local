<?php

namespace App\Repositories;

use App\Models\PrintingComment as Model;
use Illuminate\Pagination\LengthAwarePaginator;

class PrintingCommentRepository extends CoreRepository
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
    public function getAllWithPagination($nbPerPage = 10, $withTrashed = false)
    {
        $columns = ['id', 'printing_id', 'user_id', 'text', 'updated_at'];
        $relations = ['user:id,name', 'printing:id,title'];

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
}
