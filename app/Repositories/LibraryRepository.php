<?php

namespace App\Repositories;

use App\Models\Library as Model;

class LibraryRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @param int $nbPerPage
     * @return mixed
     */
    public function getAllWithPagination($nbPerPage)
    {
        return Model::paginate($nbPerPage);
    }

    /**
     * @param int $id
     * @return Model
     */
    public function getForEdit($id)
    {
        return Model::findOrFail($id);
    }
}
