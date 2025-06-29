<?php

namespace App\Http\Services;

use App\Repositories\CommonRepository;
use Illuminate\Database\Eloquent\Model;

abstract class CommonService
{
    protected CommonRepository $repository;

    public function __construct(CommonRepository $repository)
    {
        $this->repository = $repository;
    }

    protected function getList(array $filters = [], array $columns = ['*'], array $with = [], ?int $perPage = null)
    {
        return $this->repository->getList($filters, $columns, $with, $perPage);
    }

    protected function findByID(int|string $id): ?Model
    {
        return $this->repository->findByID($id);
    }

    protected function findByUuid(string $uuid, string $uuidColumn = 'uuid'): ?Model
    {
        return $this->repository->findByUuid($uuid, $uuidColumn);
    }

    protected function findByIDOrUuid(int|string $identifier, ?string $uuidColumn = 'uuid'): ?Model
    {
        return $this->repository->findByIDOrUuid($identifier, $uuidColumn);
    }

    protected function create(array $payload): Model
    {
        return $this->repository->create($payload);
    }

    protected function update(int|string $id, array $payload): Model
    {
        return $this->repository->update($id, $payload);
    }

    protected function delete(int|string $id): bool
    {
        return $this->repository->delete($id);
    }

    /**
     * Find a model by ID with specific columns.
     * @param int|string $id
     * @param array<int,string> $columns
     * @return Model|null
     */
    protected function findWithColumns(int|string $id, array $columns = ['*']): ?Model
    {
        return $this->repository->findWithColumns($id, $columns);
    }

    /**
     * Get collection by conditions.
     * @param array<string,mixed> $conditions
     * @param array<int,string> $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getWhere(array $conditions, array $columns = ['*'])
    {
        return $this->repository->getWhere($conditions, $columns);
    }

    /**
     * Get first model by conditions.
     * @param array<string,mixed> $conditions
     * @param array<int,string> $columns
     * @return Model|null
     */
    protected function getFirstWhere(array $conditions, array $columns = ['*']): ?Model
    {
        return $this->repository->getFirstWhere($conditions, $columns);
    }

    /**
     * Check if a record exists by field/value.
     * @param string $field
     * @param mixed $value
     * @return bool
     */
    protected function recordExists(string $field, $value): bool
    {
        return $this->repository->recordExists($field, $value);
    }

    /**
     * Count models with conditions.
     * @param array<string,mixed> $conditions
     * @return int
     */
    protected function countWhere(array $conditions): int
    {
        return $this->repository->countWhere($conditions);
    }

    /**
     * Find model by email address (if applicable to the model).
     * @param string $email
     * @return Model|null
     */
    protected function findByEmail(string $email): ?Model
    {
        return $this->repository->findByEmail($email);
    }

    /**
     * Get the latest record from the model's table by column and optional filter.
     * @param string $orderBy
     * @param array $filters
     * @param string $direction
     * @return Model|null
     */
    protected function getLatestRecord(string $orderBy = 'created_at', array $filters = [], string $direction = 'desc'): ?Model
    {
        return $this->repository->getLatestRecord($orderBy, $filters, $direction);
    }

    /**
     * Count all models or models with conditions.
     * If no filter is provided, counts all records. Otherwise, counts filtered records.
     *
     * @param array<string,mixed> $filter
     * @return int
     */
    protected function countAll(array $filter = []): int
    {
        if (!empty($filter)) {
            return $this->countWhere($filter);
        }
        
        return $this->repository->countAll();
    }

    /**
     * Get the latest record from any table by column and optional filter.
     * @param string $table
     * @param string $orderBy
     * @param array $filters
     * @param string $direction
     * @return object|null
     */
    protected function getLatestRecordFromTable(string $table, string $orderBy = 'created_at', array $filters = [], string $direction = 'desc'): ?object
    {
        return $this->repository->getLatestRecordFromTable($table, $orderBy, $filters, $direction);
    }
}
