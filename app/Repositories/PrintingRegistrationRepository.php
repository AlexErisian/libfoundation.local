<?php

namespace App\Repositories;

use App\Models\PrintingRegistration as Model;
use Illuminate\Pagination\LengthAwarePaginator;

class PrintingRegistrationRepository extends CoreRepository
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
        $columns = ['id', 'bookshelf_id', 'user_id',
            'exemplars_registered_initially', 'created_at', 'updated_at'];
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
