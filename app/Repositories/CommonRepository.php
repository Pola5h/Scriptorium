<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

abstract class CommonRepository
{
    /**
     * The model class this repository handles.
     *
     * @var class-string<Model>
     */
    protected string $modelClass;

    public function __construct()
    {
        if (! isset($this->modelClass) || ! is_subclass_of($this->modelClass, Model::class)) {
            throw new InvalidArgumentException('Model class is not defined or is invalid.');
        }
    }

    public function getQueryBuilder(array $filters = [])
    {
        $query = $this->modelClass::query();

        foreach ($filters as $key => $value) {
            if (! is_null($value)) {
                $query->where($key, $value);
            }
        }

        return $query;
    }

    public function findByUuid(string $uuid, string $uuidColumn = 'uuid'): ?Model
    {
        return $this->modelClass::where($uuidColumn, $uuid)->first();
    }

    public function findByID(int|string $id): ?Model
    {
        return $this->modelClass::findOrFail($id);
    }

    public function findByIDOrUuid(int|string $identifier, ?string $uuidColumn = 'uuid'): ?Model
    {
        if (is_int($identifier) || ctype_digit((string) $identifier)) {
            $model = $this->findByID($identifier);
            if ($model) {
                return $model;
            }
        }

        return $this->findByUuid($identifier, $uuidColumn);
    }

    public function getList(array $filters = [], array $columns = ['*'], array $with = [], ?int $perPage = null)
    {
        $query = $this->getQueryBuilder($filters)->with($with);

        if ($perPage) {
            return $query->paginate($perPage, $columns);
        }

        return $query->get($columns);
    }

    protected function performCreate(array $payload): Model
    {
        return $this->modelClass::create($payload);
    }

    public function create(array $payload): Model
    {
        return $this->performCreate($payload);
    }

    public function update(int|string $id, array $payload): Model
    {
        $model = $this->modelClass::findOrFail($id);
        $model->update($payload);

        return $model;
    }

    public function delete(int|string $id): bool
    {
        $model = $this->modelClass::findOrFail($id);

        return $model->delete();
    }

    public function findWithColumns(int|string $id, array $columns = ['*']): ?Model
    {
        return $this->modelClass::select($columns)->find($id);
    }

    public function countWhere(array $conditions): int
    {
        return $this->modelClass::where($conditions)->count();
    }

    public function getWhere(array $conditions, array $columns = ['*'])
    {
        return $this->modelClass::where($conditions)->get($columns);
    }

    public function getFirstWhere(array $conditions, array $columns = ['*']): ?Model
    {
        return $this->modelClass::where($conditions)->first($columns);
    }

    public function recordExists(string $field, $value): bool
    {
        return $this->modelClass::where($field, $value)->exists();
    }

    protected function validateModelClass(string $modelClass): void
    {
        if (! class_exists($modelClass) || ! is_subclass_of($modelClass, Model::class)) {
            throw new InvalidArgumentException("{$modelClass} is not a valid Eloquent model.");
        }
    }

    /**
     * Count all records in the model's table.
     * @return int
     */
    public function countAll(): int
    {
        return $this->modelClass::count();
    }

    /**
     * Get the latest record from the model's table by column and optional filter.
     * @param string $orderBy
     * @param array $filters
     * @param string $direction
     * @return Model|null
     */
    public function getLatestRecord(string $orderBy = 'created_at', array $filters = [], string $direction = 'desc'): ?Model
    {
        $query = $this->getQueryBuilder($filters);
        return $query->orderBy($orderBy, $direction)->first();
    }

    /**
     * Find model by email address.
     * @param string $email
     * @return Model|null
     */
    public function findByEmail(string $email): ?Model
    {
        return $this->getFirstWhere(['email' => $email]);
    }

    /**
     * Get the latest record from any table by column and optional filter.
     * @param string $table
     * @param string $orderBy
     * @param array $filters
     * @param string $direction
     * @return object|null
     */
    public function getLatestRecordFromTable(string $table, string $orderBy = 'created_at', array $filters = [], string $direction = 'desc'): ?object
    {
        $query = DB::table($table);

        foreach ($filters as $key => $value) {
            $query->where($key, $value);
        }

        return $query->orderBy($orderBy, $direction)->first();
    }
}
