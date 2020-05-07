<?php

namespace App\Repositories;

use App\Models\Readercard;

class ReadercardRepository
{
    /**
     * @param int $nbPerPage
     * @return mixed
     */
    public function getAllWithPagination($nbPerPage)
    {
        return Readercard::paginate($nbPerPage);
    }
}
