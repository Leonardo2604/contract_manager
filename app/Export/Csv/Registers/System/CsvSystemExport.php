<?php

namespace App\Export\Csv\Registers\System;

use App\Export\ExportInterface;
use Maatwebsite\Excel\Facades\Excel;

class CsvSystemExport implements ExportInterface
{
    public function make(array $data): string
    {
        $fileName = randomString();
        $file = "$fileName.csv";

        Excel::store(new SystemSheet($data), $file, 'temp');

        return pathResolve(storage_path(), 'temp', $file);
    }
}
