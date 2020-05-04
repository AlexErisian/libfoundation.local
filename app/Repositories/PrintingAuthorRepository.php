<?php

namespace App\Repositories;

use App\Models\PrintingAuthor;

class PrintingAuthorRepository
{
    /**
     * @param int $nbPerPage
     * @return mixed
     */
    public function getAllWithPagination($nbPerPage)
    {
        return PrintingAuthor::paginate($nbPerPage);
    }
}
