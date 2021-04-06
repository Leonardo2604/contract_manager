<?php

namespace App\Export\Pdf\Models;

class Table extends Tag
{
    public function __construct()
    {
        parent::__construct('table');
    }

    public function addRow(Row $row)
    {
        $this->addContent($row);
    }
}
