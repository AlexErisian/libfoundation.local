<?php

namespace App\Repositories;

use App\Models\PrintingRegistration;

class PrintingRegistrationRepository
{
    /**
     * @param int $nbPerPage
     * @return mixed
     */
    public function getAllWithPagination($nbPerPage)
    {
        return PrintingRegistration::with('user')->paginate($nbPerPage);
    }
}
