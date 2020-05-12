<?php

namespace App\Repositories;

use App\Models\PrintingAuthor as Model;
use Illuminate\Support\Collection;

class PrintingAuthorRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @param int $nbPerPage
     * @return mixed
     */
    public function getAllWithPagination($nbPerPage = 15)
    {
        $columns = ['id', 'name', 'born_in', 'died_in'];

        return $this->startConditions()
            ->select($columns)
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
}
