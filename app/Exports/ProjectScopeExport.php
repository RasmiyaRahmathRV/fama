<?php

namespace App\Exports;

use App\Exports\Styles\DirectScopeStyles;
use App\Services\Contracts\DirectScopeDataService;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProjectScopeExport implements FromArray, WithHeadings, WithStyles, ShouldAutoSize, WithTitle
{
    protected $contract;

    public function __construct(protected $contractId)
    {
        $this->contract = DirectScopeDataService::getContractData($contractId);
    }

    public function title(): string
    {
        return 'Project Scope';
    }

    public function array(): array
    {
        return [[$this->contract['property_name']]];
    }

    public function headings(): array
    {
        return [[], [], [], []];
    }
    public function styles(Worksheet $sheet): array
    {
        if (!$this->contract) return [];

        if (!isset($sheet)) {
            return [];
        }

        $title = "Project {$this->contract['project_number']} {$this->contract['property_name']}, {$this->contract['area']}, {$this->contract['locality']} ({$this->contract['vendor_name']}) Contract Period: {$this->contract['start_date']} to {$this->contract['end_date']}";

        $sheet->mergeCells('A1:J1');
        $sheet->setCellValue('A1', $title);
        $sheet->getStyle('A1')->applyFromArray(DirectScopeStyles::header());

        // Then just call helper methods:
        renderSummary($sheet, $this->contract, $title);
        renderUnitDetails($sheet, $this->contract);
        renderPayables($sheet, $this->contract, $title);
        renderPaymentToVendor($sheet, $this->contract);
        renderReceivables($sheet, $this->contract);
        renderTotal($sheet, $this->contract);

        foreach (range('A', 'P') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        return [];
    }
}
