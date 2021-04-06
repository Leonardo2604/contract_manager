<?php

namespace App\Export\Managers\Registers;

use App\Export\ExportManager;
use App\Export\Pdf\Registers\PdfSystemExport;
use App\Export\Csv\Registers\System\CsvSystemExport;
use App\Export\Excel\Registers\System\ExcelSystemExport;

class SystemExportManager extends ExportManager
{
    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->addExporter(parent::PDF, new PdfSystemExport());
        $this->addExporter(parent::EXCEL, new ExcelSystemExport());
        $this->addExporter(parent::CSV, new CsvSystemExport());
    }
}
