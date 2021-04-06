<?php

namespace App\Repositories\Contracts\Registers;

use App\Models\Module;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface ModuleRepositoryInterface extends RepositoryInterface
{
    /**
     * @param int $systemId
     * @throws \App\Exceptions\DatabaseException
     * @return \Illuminate\Database\Eloquent\Collection
     */
    function all(int $systemId): Collection;

    /**
     * @param int $systemId
     * @param array $data
     * @throws \App\Exceptions\DatabaseException
     * @return \App\Models\Module
     */
    function create(int $systemId, array $data): Module;

    /**
     * @param int $systemId
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws \App\Exceptions\DatabaseException
     */
    function createAll(int $systemId, array $data): Collection;

    /**
     * @param int $systemId
     * @param int $moduleId
     * @throws \App\Exceptions\DatabaseException
     * @throws \App\Exceptions\NotFoundException
     * @return \App\Models\Module
     */
    function find(int $systemId, int $moduleId): Module;

    /**
     * @param int $systemId
     * @param int $moduleId
     * @param array $data
     * @throws \App\Exceptions\DatabaseException
     * @throws \App\Exceptions\NotFoundException
     * @return bool
     */
    function update(int $systemId, int $moduleId, array $data): bool;

    /**
     * @param int $systemId
     * @param int $moduleId
     * @throws \App\Exceptions\DatabaseException
     * @throws \App\Exceptions\NotFoundException
     * @return bool
     */
    function delete(int $systemId, int $moduleId): bool;

    /**
     * @param int $systemId
     * @param array $moduleIds
     * @throws \App\Exceptions\DatabaseException
     * @return bool
     */
    function deleteAll(int $systemId, array $moduleIds): bool;
}
