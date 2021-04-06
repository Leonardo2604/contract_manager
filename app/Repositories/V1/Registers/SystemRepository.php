<?php

namespace App\Repositories\V1\Registers;

use App\Models\System;
use App\Exceptions\DatabaseException;
use App\Exceptions\NotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Contracts\Registers\SystemRepositoryInterface;
use App\Repositories\V1\AbstractRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SystemRepository extends AbstractRepository implements SystemRepositoryInterface
{
    public function all(): Collection
    {
        try {
            return System::all();
        } catch (QueryException $exception) {
            throw new DatabaseException("Falha ao tentar obter a listagem de sistemas", $exception);
        }
    }

    public function find(int $systemId): System
    {
        try {
            return System::findOrFail($systemId);
        } catch (QueryException $exception) {
            throw new DatabaseException($exception->getMessage(), $exception);
        } catch (ModelNotFoundException $exception) {
            throw new NotFoundException($exception->getMessage(), $exception);
        }
    }

    public function create(array $data): System
    {
        try {
            return System::create($data);
        } catch (QueryException $exception) {
            throw new DatabaseException($exception->getMessage(), $exception);
        }
    }

    public function update(int $systemId, array $data): bool
    {
        try {
            $system = $this->find($systemId);
            return $system->update($data);
        } catch (QueryException $exception) {
            throw new DatabaseException($exception->getMessage(), $exception);
        }
    }

    public function delete(int $systemId): bool
    {
        try {
            $system = $this->find($systemId);
            return $system->delete();
        } catch (QueryException $exception) {
            throw new DatabaseException($exception->getMessage(), $exception);
        }
    }

    public function deleteAll(array $systemIds): bool
    {
        try {
            return System::whereIn('id', $systemIds)->delete();
        } catch (QueryException $exception) {
            throw new DatabaseException($exception->getMessage(), $exception);
        }
    }
}
