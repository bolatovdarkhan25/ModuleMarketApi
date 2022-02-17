<?php

namespace App\Domain\Core;

use App\Domain\Contracts\RepositoryInterface;
use App\Domain\Core\Exceptions\RepositoryException;
use Closure;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


abstract class BaseRepository implements RepositoryInterface
{
    private Container $container;

    protected Builder $model;

    protected $newModel;

    /**
     * @throws BindingResolutionException
     * @throws RepositoryException
     */
    public function __construct
    (
        Container $container
    ) {
        $this->container = $container;

        $this->makeModel();
    }

    public abstract function model();

    public function all(array $columns = ['*']): Collection
    {
        return $this->model->get($columns);
    }

    public function with(array $relations): BaseRepository
    {
        $this->model = $this->model->with($relations);

        return $this;
    }

    public function paginate(int $perPage = 25, array $columns = ['*'], $method = 'full')
    {
        $paginationMethod = $method !== 'full' ? 'simplePaginate' : 'paginate';

        return $this->model->$paginationMethod($perPage, $columns);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function saveModel(array $data): bool
    {
        foreach ($data as $key => $value) {
            $this->model->$key = $value;
        }

        return $this->model->save();
    }

    public function update(array $data, $id, $attribute = 'id')
    {
        return $this->model->where($attribute, '=', $id)
                           ->update($data)
            ;
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }

    public function findById(int $id, array $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    public function findByColumn(string $field, $value, array $columns = ['*'])
    {
        return $this->model->where($field, '=', $value)
                           ->first($columns)
            ;
    }

    public function findAllByColumnInValues(string $field, array $values, array $columns = ['*'])
    {
        return $this->model->whereIn($field, $values)
                           ->get($columns)
            ;
    }

    public function findByMultipleConditions(array $where, array $columns = ['*'])
    {
        return $this->model->where($where)
                           ->first($columns)
            ;
    }

    public function findAllByMultipleConditions(array $where, array $columns = ['*'])
    {
        return $this->model->where($where)
                           ->get($columns)
            ;
    }

    public function findAllBy(string $field, $value, array $columns = ['*'])
    {

        return $this->model->where($field, '=', $value)
                           ->get($columns)
            ;
    }

    public function findWhere($where, array $columns = ['*'], $or = false)
    {
        $model = $this->model;

        foreach ($where as $field => $value) {
            if ($value instanceof Closure) {
                $model = (!$or)
                    ? $model->where($value)
                    : $model->orWhere($value);
            } elseif (is_array($value)) {
                if (count($value) === 3) {
                    [$field, $operator, $search] = $value;
                    $model = (!$or)
                        ? $model->where($field, $operator, $search)
                        : $model->orWhere($field, $operator, $search);
                } elseif (count($value) === 2) {
                    [$field, $search] = $value;
                    $model = (!$or)
                        ? $model->where($field, '=', $search)
                        : $model->orWhere($field, '=', $search);
                }
            } else {
                $model = (!$or)
                    ? $model->where($field, '=', $value)
                    : $model->orWhere($field, '=', $value);
            }
        }

        return $model->get($columns);
    }

    /**
     * @throws BindingResolutionException
     * @throws RepositoryException
     */
    public function makeModel()
    {
        return $this->setModel($this->model());
    }

    /**
     * @throws BindingResolutionException
     * @throws RepositoryException
     */
    public function setModel($eloquentModel)
    {
        $this->newModel = $this->container->make($eloquentModel);

        if (!$this->newModel instanceof Model) {
            throw new RepositoryException("Class $this->newModel must be an instance of " . Model::class);
        }

        return $this->model = $this->newModel;
    }

    public function getModel(): Model
    {
        return $this->newModel;
    }

//    /**
//     * @param string $input
//     * @param string $field
//     * @param int $precision
//     *
//     * @return Builder
//     */
//    public function searchWithTypos(string $input, string $field, int $precision = 3): Builder
//    {
//        return $this
//            ->model
//            ->query()
//            ->whereRaw('levenshtein(\'' . $input . '\', ' . $field . ') <= ' . $precision)
//            ;
//    }
}
