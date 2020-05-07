<?php


namespace App\Repositories;


use App\Models\PrintingType;

class PrintingTypeRepository
{
    /**
     * @param int $nbPerPage
     * @return mixed
     */
    public function getAllWithPagination($nbPerPage)
    {
        return PrintingType::paginate($nbPerPage);
    }
}
