<?php

namespace App\Repositories\BaseRepository;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\Paginator;
use App\Repositories\Interface\RepositoryInterface;

class Repository implements RepositoryInterface
{
    private $model;

    /**
     * @param Model $model The instance of the model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @method getModel()
     *
     * @return Model
     */
    protected function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @method query()
     *
     * @return Builder
     */
    protected function query(): Builder
    {
        return $this->model->newQuery();
    }

    /**
     * {@inheritdoc}
     */
    public function findOneBy(array $criteria = [], array $columns = ['*']): ?Model
    {
        return $this
            ->query()
            ->where(function ($query) use ($criteria) {
                foreach ($criteria as $column => $value) {
                    $query->where($column, $value);
                }
            })
            ->first($columns);
    }

    /**
     * {@inheritdoc}
     */
    public function findBy(array $criteria = [], array $orderBy = [], int $itemPerPage = 10, array $columns = ['*']): Paginator
    {
        return $this
            ->query()
            ->where(function ($query) use ($criteria) {
                foreach ($criteria as $column => $value) {
                    $query->where($column, $value);
                }
            })
            ->orderBy(
                Arr::get($orderBy, 'column', 'created_at'),
                Arr::get($orderBy, 'orientation', 'desc')
            )
            ->paginate($itemPerPage, $columns);
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(array $orderBy = [], int $itemPerPage = 10, array $columns = ['*']): Paginator
    {
        return $this->findBy([], $orderBy, $itemPerPage, $columns);
    }
}
