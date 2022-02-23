<?php

namespace App\Domain\Core;

use App\Domain\Contracts\RepositoryInterface;
use App\Domain\Core\Exceptions\RepositoryException;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


abstract class BaseRepository implements RepositoryInterface
{
    private Container $container;

    protected Model $model;

    /**
     * @throws BindingResolutionException
     * @throws RepositoryException
     */
    public function __construct
    (
        Container $container
    ) {
        $this->container = $container;

        $this->assignModel();
    }

    public abstract function model();

    public function all(array $columns = ['*']): Collection
    {
        return $this->model->newQuery()->get($columns);
    }

    public function create(array $data): Model|Builder
    {
        return $this->model->newQuery()->create($data);
    }

    public function saveModel(array $data): bool
    {
        foreach ($data as $key => $value) {
            $this->model->$key = $value;
        }

        return $this->model->save();
    }

    public function update(array $data, mixed $value, string $attribute = 'id'): int
    {
        return $this->model->newQuery()->where($attribute, '=', $value)->update($data);
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }

    public function findBy(string $field, $value, array $columns = ['*'])
    {
        return $this->model->newQuery()->where($field, '=', $value)->first($columns);
    }

    public function findAllByColumnInValues(string $field, array $values, array $columns = ['*'])
    {
        return $this->model->newQuery()->whereIn($field, $values)->get($columns);
    }

    public function findByMultipleConditions(array $where, array $columns = ['*'])
    {
        return $this->model->newQuery()->where($where)->first($columns);
    }

    public function findAllByMultipleConditions(array $where, array $columns = ['*'])
    {
        return $this->model->newQuery()->where($where)->get($columns);
    }

    public function findAllBy(string $field, $value, array $columns = ['*'])
    {
        return $this->model->newQuery()->where($field, '=', $value)->get($columns);
    }

    /**
     * @throws BindingResolutionException
     * @throws RepositoryException
     */
    protected function assignModel(): void
    {
        $this->setModel($this->model());
    }

    /**
     * @throws BindingResolutionException
     * @throws RepositoryException
     */
    protected function setModel($eloquentModel): void
    {
        $model = $this->container->make($eloquentModel);

        if (!$model instanceof Model) {
            throw new RepositoryException("Class $model must be an instance of " . Model::class);
        }

        $this->model = $model;
    }

    public function getModel(): Model
    {
        return $this->model;
    }
}
