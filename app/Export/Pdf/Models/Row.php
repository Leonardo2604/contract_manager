<?php

namespace App\Export\Pdf\Models;

class Row extends Tag
{
    private $backgroundColor;
    private $columns;

    public function __construct()
    {
        parent::__construct('tr');
        $this->backgroundColor = '';
    }

    public function addColumn(Column $column)
    {
        $this->columns[] = $column;
    }

    public function setColor(string $color)
    {
        $this->backgroundColor = $color;
    }

    public function __toString()
    {
        foreach ($this->columns as $column) {
            if (!empty($this->backgroundColor)) {
                $column->addProperty("style", "background-color: {$this->backgroundColor}");
            }

            $this->addContent($column);
        }

        return parent::__toString();
    }
}
