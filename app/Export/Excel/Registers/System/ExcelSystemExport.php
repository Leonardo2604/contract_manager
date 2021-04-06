<?php

namespace App\Export\Excel\Registers\System;

use App\Export\ExportInterface;
use Maatwebsite\Excel\Facades\Excel;

class ExcelSystemExport implements ExportInterface
{
    public function make(array $data): string
    {
        $fileName = randomString();
        $file = "$fileName.xls";

        Excel::store(new SystemSheet($data), $file, 'temp');

        return pathResolve(storage_path(), 'temp', $file);
    }
}
