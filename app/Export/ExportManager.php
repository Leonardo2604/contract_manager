<?php

namespace App\Export;

use Throwable;
use ZipArchive;

abstract class ExportManager
{
    private $data;
    private $exporters;
    protected const PDF = 'pdf';
    protected const EXCEL = 'excel';
    protected const CSV = 'csv';

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    protected function addExporter(string $exportType, ExportInterface $exporter)
    {
        $this->exporters[$exportType] = $exporter;
    }

    /**
     * @return array - array de strings - os caminhos dos arquivos criados
     */
    public function make(array $types): array
    {
        $files = [];

        foreach ($types as $type) {
            $exporter = null;

            if (isset($this->exporters[$type])) {
                $exporter = $this->exporters[$type];
            } else {
                continue;
            }

            try {
                $files[] = $exporter->make($this->data);
            } catch (Throwable $exception) {

                /**
                 * se por acaso der algum problema com a geração de algum arquivo,
                 * apago os que já foram criados. Para que não fiquem acumulados na
                 * pasta temp
                */
                foreach ($files as $file) {
                    if (file_exists($file)) {
                        unlink($file);
                    }
                }

                throw $exception;
            }
        }

        return $files;
    }

    public function makeZip(array $types): string
    {
        $files = $this->make($types);

        $zip = new ZipArchive();
        $zipName = randomString() . '.zip';
        $zipPath = pathResolve(storage_path(), 'temp', $zipName);

        if ($zip->open($zipPath, ZipArchive::CREATE) === true) {
            foreach ($files as $file) {
                $zip->addFile($file, basename($file));
            }
        }

        $zip->close();

        foreach ($files as $file) {
            unlink($file);
        }

        return $zipPath;
    }
}
