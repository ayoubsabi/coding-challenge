<?php

namespace App\Repositories\BaseRepository;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\Paginator;
use App\Repositories\Interface\RepositoryInterface;

class ModelRepository implements RepositoryInterface
{
    private $model;

    /**
     * @param string $modelClassName The class name of the model
     */
    public function __construct(string $modelClassName)
    {
        throw_if(
            ! class_exists($modelClassName),
            new Exception(sprintf("%s class not found", $modelClassName))
        );

        $model = app($modelClassName);

        throw_if(
            ! $model instanceof Model,
            new Exception(sprintf("This class is not an instance of %s", Model::class))
        );

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
     * @method getTableColumns()
     *
     * @return array
     */
    protected function getTableColumns(): array
    {
        return Schema::getColumnListing($this->model->getTable());
    }

    /**
     * {@inheritdoc}
     */
    public function findOneBy(array $criteria = [], array $columns = ['*']): ?Model
    {
        return $this
            ->model
            ->newQuery()
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
            ->model
            ->newQuery()
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
