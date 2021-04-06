<?php

namespace App\Repositories\V1;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Support\Facades\DB;

abstract class AbstractRepository implements RepositoryInterface
{
    public function beginTransaction()
    {
        DB::beginTransaction();
    }

    public function commit()
    {
        DB::commit();
    }

    public function rollback()
    {
        DB::rollback();
    }
}
