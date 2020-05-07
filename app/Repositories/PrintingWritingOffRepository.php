<?php


namespace App\Repositories;


use App\Models\PrintingWritingOff;

class PrintingWritingOffRepository
{
    /**
     * @param int $nbPerPage
     * @return mixed
     */
    public function getAllWithPagination($nbPerPage)
    {
        return PrintingWritingOff::with('user')->paginate($nbPerPage);
    }
}
