<?php

namespace App\Repositories;

use App\Models\LibraryService;

class LibraryServiceRepository
{
    /**
     * @param int $nbPerPage
     * @return mixed
     */
    public function getAllWithPagination($nbPerPage)
    {
        return LibraryService::with(['user', 'readercard'])
            ->paginate($nbPerPage);
    }
}
