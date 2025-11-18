<?php

namespace App\Exports\Styles;

use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class FFScopeStyles
{
    public static function header(): array
    {
        return [
            'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => '000000']],
            'alignment' => ['horizontal' => 'center'],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => 'FFFF00']],
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

    public static function headerFama(): array
    {
        return [
            'font' => ['bold' => true, 'size' => 11],
            'alignment' => ['horizontal' => 'center'],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => 'F8CBAD']],
        ];
    }

    public static function summaryLeft(): array
    {
        return [
            // 'font' => ['bold' => true],
            'alignment' => ['horizontal' => 'left', 'vertical' => 'center'],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => 'F8CBAD']],
        ];
    }

    public static function summaryRight(): array
    {
        return [
            // 'font' => ['bold' => true],
            'alignment' => ['horizontal' => 'right', 'vertical' => 'center'],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => 'F8CBAD']],
        ];
    }

    public static function summaryFF(): array
    {
        return [
            'alignment' => ['horizontal' => 'left', 'vertical' => 'center'],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['rgb' => 'B4C6E7'], // background color (green)
            ],
        ];
    }

    public static function paymentSummaryFF(): array
    {
        return [
            'alignment' => ['horizontal' => 'left', 'vertical' => 'center'],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['rgb' => '92D050'], // background color (green)
            ],
        ];
    }


    public static function renewalLeftSummaryFF(): array
    {
        return [
            'font' => ['bold' => true],
            'alignment' => ['horizontal' => 'left', 'vertical' => 'center'],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['rgb' => 'C9C9C9'], // background color (grey)
            ],
        ];
    }

    public static function renewalCenterSummaryFF(): array
    {
        return [
            'font' => ['bold' => true],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['rgb' => 'C9C9C9'], // background color (grey)
            ],
        ];
    }

    public static function clearstyleFF(): array
    {
        return [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['rgb' => 'FFFFFF'], // background color (grey)
            ],
        ];
    }

    public static function renewColorChange(): array
    {
        return [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['rgb' => 'B4C6E7'], // background color (grey)
            ],
        ];
    }
}
