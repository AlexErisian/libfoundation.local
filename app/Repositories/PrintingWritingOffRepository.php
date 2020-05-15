<?php

namespace App\Repositories;

use App\Models\PrintingWritingOff as Model;
use Illuminate\Pagination\LengthAwarePaginator;

class PrintingWritingOffRepository extends BaseRepository
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
        $columns = ['id', 'user_id', 'bookshelf_id',
            'exemplars_written_off', 'created_at'];
        $relations = ['user:id,name'];

        return $this->startConditions()
            ->select($columns)
            ->with($relations)
            ->withTrashed($withTrashed)
            ->orderBy('id', 'desc')
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
