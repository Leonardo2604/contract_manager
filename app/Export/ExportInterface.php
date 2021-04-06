<?php

namespace App\Export;

interface ExportInterface
{
    /**
     * @return string - caminho para o arquivo criado
     */
    function make(array $data): string;
}
