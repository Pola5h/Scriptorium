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

    public function getList(array $filters = [], array $columns = ['*'], array $with = [], ?int $perPage = null)
    {
        return $this->repository->getList($filters, $columns, $with, $perPage);
    }

    public function findByID(int|string $id): ?Model
    {
        return $this->repository->findByID($id);
    }

    public function findByUuid(string $uuid, string $uuidColumn = 'uuid'): ?Model
    {
        return $this->repository->findByUuid($uuid, $uuidColumn);
    }

    public function findByIDOrUuid(int|string $identifier, ?string $uuidColumn = 'uuid'): ?Model
    {
        return $this->repository->findByIDOrUuid($identifier, $uuidColumn);
    }

    public function create(array $payload): Model
    {
        return $this->repository->create($payload);
    }

    public function update(int|string $id, array $payload): Model
    {
        return $this->repository->update($id, $payload);
    }

    public function delete(int|string $id): bool
    {
        return $this->repository->delete($id);
    }
}
