<?php

namespace App\Repositories;

use App\Models\Bookshelf as Model;
use Illuminate\Pagination\LengthAwarePaginator;

class BookshelfRepository extends CoreRepository
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
        $columns = ['id', 'library_id', 'printing_id',
            'exemplars_registered', 'exemplars_in_stock',];
        $relations = ['library:id,name', 'printing:id,title'];

        return $this->startConditions()
            ->select($columns)
            ->with($relations)
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
