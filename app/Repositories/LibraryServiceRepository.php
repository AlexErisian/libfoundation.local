<?php

namespace App\Repositories;

use App\Models\LibraryService as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class LibraryServiceRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @param int $nbPerPage
     * @param bool $withTrashed
     * @return LengthAwarePaginator
     */
    public function getAllWithPagination($nbPerPage = 15, $withTrashed = false)
    {
        $columns = ['id', 'user_id', 'readercard_id', 'bookshelf_id',
            'exemplars_given', 'created_at', 'given_up_to', 'returned_at'];
        $relations = ['user:id,name', 'readercard:id,code'];

        return $this->startConditions()
            ->select($columns)
            ->with($relations)
            ->withTrashed($withTrashed)
            ->orderBy('id', 'desc')
            ->paginate($nbPerPage);
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function getAllByReadercardId($id)
    {
        $columns = ['id', 'readercard_id', 'bookshelf_id',
            'exemplars_given', 'created_at', 'given_up_to', 'returned_at'];

        $relations = [
            'bookshelf:id,printing_id,library_id',
            'bookshelf.printing:id,title',
            'bookshelf.library:id,name'
        ];

        return $this->startConditions()
            ->select($columns)
            ->with($relations)
            ->where('readercard_id', $id)
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * @param int $id
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }
}
