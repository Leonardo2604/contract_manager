<?php

namespace App\Repositories\V1\Registers;

use App\Models\Module;
use App\Exceptions\DatabaseException;
use App\Exceptions\NotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Contracts\Registers\ModuleRepositoryInterface;
use App\Repositories\V1\AbstractRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ModuleRepository extends AbstractRepository implements ModuleRepositoryInterface
{
    public function all(int $systemId): Collection
    {
        try {
            return Module::ofSystem($systemId)->get();
        } catch (QueryException $exception) {
            throw new DatabaseException("Falha ao tentar obter a listagem de sistemas", $exception);
        }
    }

    public function find(int $systemId, int $moduleId): Module
    {
        try {
            return Module::ofSystem($systemId)->findOrFail($moduleId);
        } catch (QueryException $exception) {
            throw new DatabaseException($exception->getMessage(), $exception);
        } catch (ModelNotFoundException $exception) {
            throw new NotFoundException($exception->getMessage(), $exception);
        }
    }

    public function create(int $systemId, array $data): Module
    {
        try {
            $data['system_id'] = $systemId;
            return Module::create($data);
        } catch (QueryException $exception) {
            throw new DatabaseException($exception->getMessage(), $exception);
        }
    }

    public function createAll(int $systemId, array $data): Collection
    {
        for($i = 0; $i < count($data); $i++) {
            $data[$i]['system_id'] = $systemId;
        }

        try {
            Module::insert($data);
            return $this->all($systemId);
        } catch (QueryException $exception) {
            throw new DatabaseException($exception->getMessage(), $exception);
        }
    }

    public function update(int $systemId, int $moduleId, array $data): bool
    {
        try {
            $system = $this->find($systemId, $moduleId);
            return $system->update($data);
        } catch (QueryException $exception) {
            throw new DatabaseException($exception->getMessage(), $exception);
        }
    }

    public function delete(int $systemId, int $moduleId): bool
    {
        try {
            $system = $this->find($systemId, $moduleId);
            return $system->delete();
        } catch (QueryException $exception) {
            throw new DatabaseException($exception->getMessage(), $exception);
        }
    }

    public function deleteAll(int $systemId, array $moduleIds): bool
    {
        try {
            return Module::ofSystem($systemId)->whereIn('id', $moduleIds)->delete();
        } catch (QueryException $exception) {
            throw new DatabaseException($exception->getMessage(), $exception);
        }
    }
}
