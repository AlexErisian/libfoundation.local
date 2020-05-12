<?php

namespace App\Repositories;

use App\Models\Role as Model;

class RoleRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @return mixed
     */
    public function getListing()
    {
        $columns = ['id', 'name', 'created_at', 'updated_at'];

        return $this->startConditions()
            ->get($columns);
    }

    /**
     * @param int $id
     * @return Model
     */
    public function getById($id)
    {
        return $this->startConditions()
            ->find($id);
    }

    /**
     * @param int $excludingId
     * @return mixed
     */
    public function getSelectOptions($excludingId = 0)
    {
        $columns = ['id', 'name'];

        return $this->startConditions()
            ->where('id', '!=', $excludingId)
            ->toBase()
            ->get($columns);
    }
}
