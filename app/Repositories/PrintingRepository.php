<?php

namespace App\Repositories;

use App\Models\Printing as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Storage;

class PrintingRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @param array $requestData
     * @param int $nbPerPage
     * @return LengthAwarePaginator
     */
    public function applyFilter($requestData, $nbPerPage = 10)
    {
        $columns = [
            'id', 'printing_author_id', 'printing_pubhouse_id', 'printing_type_id',
            'title', 'publication_year', 'isbn',
            'annotation', 'picture_path',
        ];
        $relations = [
            'author:id,name',
            'pubhouse:id,name',
            'type:id,name',
            'genres'
        ];

        $whereConditions = [];
        if ($requestData['printing_author_id'] ?? 0 >= 1) {
            $whereConditions[] = [
                'printing_author_id',
                '=',
                $requestData['printing_author_id']
            ];
        }
        if ($requestData['printing_pubhouse_id'] ?? 0 >= 1) {
            $whereConditions[] = [
                'printing_pubhouse_id',
                '=',
                $requestData['printing_pubhouse_id']
            ];
        }
        if ($requestData['printing_type_id'] ?? 0 >= 1) {
            $whereConditions[] = [
                'printing_type_id',
                '=',
                $requestData['printing_type_id']
            ];
        }
        if (!empty($requestData['printing_title'])) {
            $whereConditions[] = [
                'title',
                'like',
                '%'.$requestData['printing_title'].'%'
            ];
        }

        $pagination = $this->startConditions()
            ->select($columns)
            ->where($whereConditions)
            ->with($relations);

        if (!empty($requestData['genre_ids'])) {
            $ids = $requestData['genre_ids'];
            $pagination->whereHas('genres', function (Builder $query) use ($ids) {
                $query->whereIn('printing_genres.id', $ids);
            }, '>=', count($ids));
        }

        return $pagination
            ->orderBy('id', 'desc')
            ->paginate($nbPerPage);
    }

    public function getForMainPage($count)
    {
        $columns = [
            'id', 'printing_author_id',
            'title', 'publication_year', 'annotation', 'picture_path',
            'created_at'
        ];
        $relations = ['author:id,name',];

        return $this->startConditions()
            ->select($columns)
            ->with($relations)
            ->orderBy('id', 'desc')
            ->take($count)
            ->get();
    }

    public function getForIndexPage($nbPerPage)
    {
        $columns = [
            'id', 'printing_author_id', 'printing_pubhouse_id', 'printing_type_id',
            'title', 'publication_year', 'isbn',
            'annotation', 'picture_path',
        ];
        $relations = [
            'author:id,name',
            'pubhouse:id,name',
            'type:id,name',
            'genres'
        ];

        return $this->startConditions()
            ->select($columns)
            ->with($relations)
            ->orderBy('id', 'desc')
            ->paginate($nbPerPage);
    }

    /**
     * @param int $nbPerPage
     * @param bool $withTrashed
     * @return mixed
     */
    public function getAllWithPagination($nbPerPage = 15, $withTrashed = false)
    {
        $columns = [
            'id', 'printing_author_id', 'printing_pubhouse_id', 'printing_type_id',
            'title', 'publication_year', 'isbn'
        ];
        $relations = [
            'author:id,name',
            'pubhouse:id,name',
            'type:id,name',];

        return $this->startConditions()
            ->select($columns)
            ->with($relations)
            ->orderBy('id', 'desc')
            ->withTrashed($withTrashed)
            ->paginate($nbPerPage);
    }

    /**
     * @param int $excludingId
     * @return Collection
     */
    public function getSelectOptions($excludingId = 0)
    {
        $columns = ['id', 'title'];

        return $this->startConditions()
            ->where('id', '!=', $excludingId)
            ->orderBy('title')
            ->toBase()
            ->get($columns);
    }

    /**
     * @param int $id
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    /**
     * @param string $title
     * @param int $nbPerPage
     * @return LengthAwarePaginator
     */
    public function getAllWithTitleLike($title, $nbPerPage = 15)
    {
        $columns = [
            'id', 'printing_author_id', 'printing_pubhouse_id', 'printing_type_id',
            'title', 'publication_year', 'isbn'];
        $relations = [
            'author:id,name',
            'pubhouse:id,name',
            'type:id,name',];

        return $this->startConditions()
            ->select($columns)
            ->where('title', 'like', '%' . $title . '%')
            ->with($relations)
            ->orderBy('id', 'desc')
            ->paginate($nbPerPage);
    }

    /**
     * @param array $requestData
     * @return array
     */
    public function saveModel($requestData)
    {
        $model = $this->startConditions();

        if (!empty($requestData['picture'])) {
            $newPath = Storage::disk('public')
                ->putFile('/images/printings', $requestData['picture']);
            $requestData['picture_path'] = $newPath;
        }

        return [
            'succeed' => $model->fill($requestData)->save(),
            'id' => $model->id,
        ];
    }

    /**
     * @param Model $model
     * @param array $requestData
     * @return bool
     */
    public function updateModel(Model $model, $requestData)
    {
        $model->genres()->sync($requestData['genre_ids']);

        if (!empty($requestData['picture'])) {
            $newPath = Storage::disk('public')
                ->putFile('/images/printings', $requestData['picture']);
            $oldPath = $model->picture_path;
            if (!empty($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
            $requestData['picture_path'] = $newPath;
        }

        return $model->fill($requestData)->update();
    }
}
