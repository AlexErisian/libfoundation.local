<?php

namespace App\Repositories;

use App\Models\PrintingGenre;

class PrintingGenreRepository
{
    /**
     * @param int $nbPerPage
     * @return mixed
     */
    public function getAllWithPagination($nbPerPage)
    {
        return PrintingGenre::paginate($nbPerPage);
    }
}
