<?php

namespace App\Export\Pdf\Models;

class Column extends Tag
{
    public function __construct(string $value, bool $isHeaderColumn = false)
    {
        $tag = 'td';

        if ($isHeaderColumn) {
            $tag = 'th';
        }

        parent::__construct($tag, $value);
    }

    public function setColspan(int $columns)
    {
        $this->addProperty('colspan', $columns);
    }
}
