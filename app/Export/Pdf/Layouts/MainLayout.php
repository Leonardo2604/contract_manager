<?php

namespace App\Export\Pdf\Layouts;

use TCPDF;

class MainLayout extends TCPDF
{
    public const MARGIN_RIGHT = 10;
    public const MARGIN_LEFT = 10;
    public const WIDTH = 210;
    public const HEIGHT = 297;
    public const SAFE_WIDTH = (self::WIDTH - self::MARGIN_LEFT - self::MARGIN_RIGHT);
    public const START_CONTENT = 45;
    public const END_CONTENT = 280;

    public function Header()
    {
        // $this->SetXY(0, 0);

        // $w,
        // $h = 0,
        // $txt = '',
        // $border = 0,
        // $ln = 0,
        // $align = '',
        // $fill = false,
        // $link = '',
        // $stretch = 0,
        // $ignore_min_height = false,
        // $calign = 'T',
        // $valign = 'M'

        // $this->Cell(5, 297, '', false, false, '', true);

        // $file,
        // $x = '',
        // $y = '',
        // $w = 0,
        // $h = 0,
        // $type = '',
        // $link = '',
        // $align = '',
        // $resize = false,
        // $dpi = 300,
        // $palign = '',
        // $ismask = false,
        // $imgmask = false,
        // $border = 0,
        // $fitbox = false,
        // $hidden = false,
        // $fitonpage = false,
        // $alt = false,
        // $altimgs = array()
        $this->Image(public_path('imgs/dtc-logo.png'), self::MARGIN_LEFT, 7.5, 45);

        // $w,
        // $h,
        // $x,
        // $y,
        // $html = '',
        // $border = 0,
        // $ln = 0,
        // $fill = false,
        // $reseth = true,
        // $align = '',
        // $autopadding = true

        $htmlInfo = <<<EOD
            <div style="text-align: right; font-size: 10px;">
            <br />
                Data Campos Informática <br />
                End.: R. Edmundo Chagas, 36 - Centro, Campos dos Goytacazes - RJ, 28020-740  <br />
                Tel.: (22) 2738-2550  <br />
            </div>
        EOD;

        $this->writeHTMLCell(140, 17.5, 60, 5, $htmlInfo, false);

        // $x1,
        // $y1,
        // $x2,
        // $y2,
        // $style = array()
        $this->Line(self::MARGIN_LEFT, 28, (self::WIDTH - self::MARGIN_RIGHT), 28);

        $this->writeHTMLCell(self::SAFE_WIDTH, 10, self::MARGIN_LEFT, 32, '<h1 style="text-align: center;">Relatório de Sistemas</h1>', false);

    }

    public function Footer()
    {
        // $this->Line(0, 285, 210, 285);
        $this->writeHTMLCell(self::SAFE_WIDTH, 7, self::MARGIN_LEFT, 285, '
            <div style="text-align: center; line-height: 20px; font-size: 13px;"><strong>1/1</strong></div>
        ', false);
    }
}
