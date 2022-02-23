<?php

namespace App\Domain\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface RepositoryInterface
{
    /**
     * @param array $columns
     *
     * @return Collection|Builder[]
     */
    public function all(array $columns = ['*']): Collection|array;

    /**
     * @param array $data
     *
     * @return Model|Builder
     */
    public function create(array $data): Model|Builder;

    /**
     * @param array $data
     *
     * @return bool
     */
    public function saveModel(array $data): bool;

    /**
     * @param array $data
     * @param mixed $value
     * @param string $attribute
     *
     * @return int
     */
    public function update(array $data, mixed $value, string $attribute = 'id'): int;

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function delete(int $id);

    /**
     * @param string $field
     * @param mixed  $value
     * @param array  $columns
     *
     * @return mixed
     */
    public function findBy(string $field, $value, array $columns = ['*']);

    /**
     * @param string $field
     * @param array $values
     * @param array $columns
     * @return mixed
     */
    public function findAllByColumnInValues(string $field, array $values, array $columns = ['*']);

    /**
     * @param array $where
     * @param array $columns
     * @return mixed
     */
    public function findByMultipleConditions(array $where, array $columns = ['*']);

    /**
     * @param array $where
     * @param array $columns
     * @return mixed
     */
    public function findAllByMultipleConditions(array $where, array $columns = ['*']);

    /**
     * @param string $field
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findAllBy(string $field, $value, array $columns = ['*']);
}
