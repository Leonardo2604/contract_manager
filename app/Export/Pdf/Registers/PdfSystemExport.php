<?php

namespace App\Export\Pdf\Registers;

use App\Export\ExportInterface;
use App\Export\Pdf\Layouts\MainLayout;

class PdfSystemExport implements ExportInterface
{
    public function make(array $systems): string
    {
        $pdf = new MainLayout(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Leonardo Rangel dos Santos');
        $pdf->SetTitle('Sistemas');
        $pdf->SetSubject('Relatório de Sistemas Cadastrados');

        $pdf->SetMargins(MainLayout::MARGIN_LEFT, MainLayout::START_CONTENT, MainLayout::MARGIN_RIGHT);

        $pdf->SetAutoPageBreak(true, (MainLayout::HEIGHT - MainLayout::END_CONTENT));

        $pdf->SetFont('dejavusans', '', 14, '', true);

        $pdf->AddPage();

        $html = <<<EOD
            <table cellpadding="7" style="width: 100%;">
                <thead>
                    <tr>
                        <th style="font-size: 12px; padding: 15px; border-bottom: 1px solid #000; background-color: #c3c3c3;">Nome</th>
                        <th style="font-size: 12px; padding: 15px; border-bottom: 1px solid #000; background-color: #c3c3c3;">Descrição</th>
                        <th style="font-size: 12px; padding: 15px; border-bottom: 1px solid #000; background-color: #c3c3c3; text-align: center;">Versão</th>
                    </tr>
                </thead>
                <tbody>
        EOD;

        foreach ($systems as $key => $system) {
            if ($key % 2 != 0) {
                $html .= <<<EOD
                <tr>
                        <td style="font-size: 10px; background-color: #f3f3f3; border-bottom: 1px solid #000; padding: 15px;">{$system['name']}</td>
                        <td style="font-size: 10px; background-color: #f3f3f3; border-bottom: 1px solid #000; padding: 15px;">{$system['description']}</td>
                        <td style="font-size: 10px; background-color: #f3f3f3; border-bottom: 1px solid #000; padding: 15px; text-align: center;">{$system['version']}</td>
                    </tr>
                EOD;
            } else {
                $html .= <<<EOD
                <tr>
                        <td style="font-size: 10px; border-bottom: 1px solid #000; padding: 15px;">{$system['name']}</td>
                        <td style="font-size: 10px; border-bottom: 1px solid #000; padding: 15px;">{$system['description']}</td>
                        <td style="font-size: 10px; border-bottom: 1px solid #000; padding: 15px; text-align: center;">{$system['version']}</td>
                    </tr>
                EOD;
            }
        }

        $html .= "</tbody></table>";

        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        $this->filePath = pathResolve(storage_path(), 'temp', randomString() . '.pdf');

        $pdf->Output($this->filePath, 'F');

        return $this->filePath;
    }
}
