<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    function beginTransaction();

    function commit();

    function rollback();
}
