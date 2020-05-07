<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{
    /**
     * @param int $nbPerPage
     * @return mixed
     */
    public function getAllWithPagination($nbPerPage)
    {
        return Post::with('user')->paginate($nbPerPage);
    }
}
