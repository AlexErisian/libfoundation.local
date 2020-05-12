<?php

namespace App\Repositories;

use App\Models\PrintingGenre as Model;
use Illuminate\Support\Collection;

class PrintingGenreRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @param int $nbPerPage
     * @return mixed
     */
    public function getAllWithPagination($nbPerPage = 25)
    {
        $columns = ['id', 'name',];

        return $this->startConditions()
            ->select($columns)
            ->paginate($nbPerPage);
    }

    /**
     * @param int[] $excludingIds
     * @return Collection
     */
    public function getMultiSelectOptions($excludingIds = [0])
    {
        $columns = ['id', 'name'];

        return $this->startConditions()
            ->whereNotIn('id', $excludingIds)
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
}
