<?php

namespace App\Domain\Contracts;

interface RepositoryInterface
{
    /**
     * @param array $columns
     *
     * @return mixed
     */
    public function all(array $columns = ['*']);

    /**
     * @param int   $perPage
     * @param array $columns
     *
     * @return mixed
     */
    public function paginate(int $perPage = 1, array $columns = ['*']);

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param array $data
     *
     * @return bool
     */
    public function saveModel(array $data): bool;

    /**
     * @param array $data
     * @param int   $id
     *
     * @return mixed
     */
    public function update(array $data, int $id);

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function delete(int $id);

    /**
     * @param int   $id
     * @param array $columns
     *
     * @return mixed
     */
    public function find(int $id, array $columns = ['*']);

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
     * @param mixed  $value
     * @param array  $columns
     *
     * @return mixed
     */
    public function findAllBy(string $field, $value, array $columns = ['*']);

    /**
     * @param mixed $where
     * @param array $columns
     *
     * @return mixed
     */
    public function findWhere($where, array $columns = ['*']);
}
