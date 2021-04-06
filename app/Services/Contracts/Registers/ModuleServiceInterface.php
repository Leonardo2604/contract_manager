<?php

namespace App\Services\Contracts\Registers;

use App\Models\Module;
use Illuminate\Database\Eloquent\Collection;

interface ModuleServiceInterface
{
    /**
     * @param int $systemId
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws \App\Exceptions\DatabaseException
     */
    function all(int $systemId): Collection;

    /**
     * @param int $systemId
     * @param array $data
     * @return \App\Models\Module
     * @throws \App\Exceptions\DatabaseException
     * @throws \App\Exceptions\UnprocessableEntityException
     */
    function create(int $systemId, array $data): Module;

    /**
     * @param int $systemId
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws \App\Exceptions\DatabaseException
     * @throws \App\Exceptions\UnprocessableEntityException
     */
    function createAll(int $systemId, array $data): Collection;

    /**
     * @param int $systemId
     * @param int $moduleId
     * @return \App\Models\Module
     * @throws \App\Exceptions\DatabaseException
     * @throws \App\Exceptions\NotFoundException
     */
    function find(int $systemId, int $moduleId): Module;

    /**
     * @param int $systemId
     * @param int $moduleId
     * @param array $data
     * @return bool
     * @throws \App\Exceptions\DatabaseException
     * @throws \App\Exceptions\NotFoundException
     * @throws \App\Exceptions\UnprocessableEntityException
     */
    function update(int $systemId, int $moduleId, array $data): bool;

    /**
     * @param int $systemId
     * @param int $moduleId
     * @return bool
     * @throws \App\Exceptions\DatabaseException
     * @throws \App\Exceptions\NotFoundException
     */
    function delete(int $systemId, int $moduleId): bool;

    /**
     * @param int $systemId
     * @param array $moduleIds
     * @return bool
     * @throws \App\Exceptions\DatabaseException
     */
    function deleteAll(int $systemId, array $moduleIds): bool;
}
