<?php

namespace App\Repositories;

use App\Models\PrintingPubhouse;

class PrintingPubhouseRepository
{
    /**
     * @param int $nbPerPage
     * @return mixed
     */
    public function getAllWithPagination($nbPerPage)
    {
        return PrintingPubhouse::paginate($nbPerPage);
    }
}
