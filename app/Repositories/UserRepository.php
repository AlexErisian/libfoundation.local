<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * @param int $nbPerPage
     * @return mixed
     */
    public function getAllWithPagination($nbPerPage)
    {
        return User::with('role')->paginate($nbPerPage);
    }
}
