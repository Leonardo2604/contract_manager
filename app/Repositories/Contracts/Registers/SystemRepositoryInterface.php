<?php

namespace App\Repositories\Contracts\Registers;

use App\Models\System;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface SystemRepositoryInterface extends RepositoryInterface
{
    /**
     * @throws \App\Exceptions\DatabaseException
     * @return \Illuminate\Database\Eloquent\Collection
     */
    function all(): Collection;

    /**
     * @param array $data
     * @throws \App\Exceptions\DatabaseException
     * @return \App\Models\System
     */
    function create(array $data): System;

    /**
     * @param int $systemId
     * @throws \App\Exceptions\DatabaseException
     * @throws \App\Exceptions\NotFoundException
     * @return \App\Models\System
     */
    function find(int $systemId): System;

    /**
     * @param int $systemId
     * @param array $data
     * @throws \App\Exceptions\DatabaseException
     * @throws \App\Exceptions\NotFoundException
     * @return bool
     */
    function update(int $systemId, array $data): bool;

    /**
     * @param int $systemId
     * @throws \App\Exceptions\DatabaseException
     * @throws \App\Exceptions\NotFoundException
     * @return bool
     */
    function delete(int $systemId): bool;

    /**
     * @param array $systemIds
     * @throws \App\Exceptions\DatabaseException
     * @return bool
     */
    function deleteAll(array $systemIds): bool;
}
