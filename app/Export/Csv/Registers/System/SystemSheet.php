<?php

namespace App\Export\Csv\Registers\System;

use Maatwebsite\Excel\Concerns\FromArray;

class SystemSheet implements FromArray
{
    private $systems;

    public function __construct(array $systems)
    {
        $this->systems = $systems;
    }

    public function array(): array
    {
        return $this->systems;
    }
}
