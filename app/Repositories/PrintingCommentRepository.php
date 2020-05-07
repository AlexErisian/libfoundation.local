<?php

namespace App\Repositories;

use App\Models\PrintingComment;

class PrintingCommentRepository
{
    /**
     * @param int $nbPerPage
     * @return mixed
     */
    public function getAllWithPagination($nbPerPage)
    {
        return PrintingComment::with(['user', 'printing'])
            ->paginate($nbPerPage);
    }
}
