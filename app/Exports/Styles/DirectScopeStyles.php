<?php

namespace App\Exports\Styles;

use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class DirectScopeStyles
{
    public static function header(): array
    {
        return [
            'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => 'FFFFFF']],
            'alignment' => ['horizontal' => 'center'],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => '1F4E78']],
        ];
    }

    public static function summary(): array
    {
        return [
            'font' => ['bold' => true],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => 'F8CBAD']],
        ];
    }

    public static function unitTable(): array
    {
        return [
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => '9BC2E6']],
        ];
    }

    public static function payable(): array
    {
        return [
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => 'B4C6E7']],
        ];
    }

    public static function receivable(): array
    {
        return [
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => 'C6E0B4']],
        ];
    }
}
