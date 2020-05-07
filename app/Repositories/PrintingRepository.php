<?php

namespace App\Repositories;

use App\Models\Printing;

class PrintingRepository
{
    /**
     * @param int $nbPerPage
     * @return mixed
     */
    public function getAllWithPagination($nbPerPage)
    {
        return Printing::with(['author', 'pubhouse', 'type'])
            ->paginate($nbPerPage);
    }
}
