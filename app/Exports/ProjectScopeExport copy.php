<?php

namespace App\Exports;

use App\Models\Contract;
use DateTime;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ProjectScopeExport implements FromArray, WithHeadings, WithStyles, ShouldAutoSize, WithTitle
{
    protected $data;

    public function __construct(protected $contractId)
    {
        // Fetch the contract with related tables
        $contracts = Contract::with([
            'contract_unit',
            'contract_rentals',
            'contract_detail',
            'contract_otc',
            'contract_payments',
            'contract_payment_details',
            'contract_unit_details',
            'contract_payment_receivables',
            'vendor', // ensure vendor relation exists
        ])
            ->whereIn('contract_status', [0, 1])
            ->where('contracts.id', $this->contractId)
            ->first();

        $this->data[] = [
            'project_number'     => $contracts->project_number ?? '',
            'property_name'  => $contracts->property?->property_name ?? '',
            'area'           => $contracts->area?->area_name ?? '',
            'locality'       => $contracts->locality?->locality_name ?? '',
            'vendor_name'    => $contracts->vendor?->vendor_name ?? '',
            'start_date'     => $contracts->contract_detail?->start_date ? $contracts->contract_detail?->start_date : '',
            'end_date'       => $contracts->contract_detail?->end_date ? $contracts->contract_detail?->end_date : '',


            'total_units'    => $contracts->contract_unit?->no_of_units ?? 0,
            'total_contract_amount' => formatNumber($contracts->contract_rentals?->rent_per_annum_payable),
            'unit_type' => $contracts->contract_unit?->unit_type_count,
            'grace_period' => $contracts->contract_detail?->grace_period,
            'commission' => formatNumber($contracts->contract_rentals?->commission),
            'contract_fee' => formatNumber($contracts->contract_detail?->contract_fee),
            'refundable_deposit' => formatNumber($contracts->contract_rentals?->deposit),
            'total_payment_to_vendor' => formatNumber($contracts->contract_rentals?->total_payment_to_vendor),
            'total_otc' => formatNumber($contracts->contract_rentals?->total_otc),
            'final_cost' => formatNumber($contracts->contract_rentals?->final_cost),
            'initial_investment' => formatNumber($contracts->contract_rentals?->initial_investment),
            'expected_profit' => formatNumber($contracts->contract_rentals?->expected_profit),
            'roi' => $contracts->contract_rentals?->roi_perc,

            'cost_of_development' => formatNumber($contracts->contract_otc?->cost_of_development),
            'cost_of_beds' => formatNumber($contracts->contract_otc?->cost_of_bed),
            'cost_of_mattresses' => formatNumber($contracts->contract_otc?->cost_of_matress),
            'cost_of_cabinets' => formatNumber($contracts->contract_otc?->cost_of_cabinets),
            'appliances' => formatNumber($contracts->contract_otc?->appliances),
            'decoration' => formatNumber($contracts->contract_otc?->decoration),
            'dewa_deposit' => formatNumber($contracts->contract_otc?->dewa_deposit),
            'expected_rental' => formatNumber($contracts->contract_rentals?->rent_receivable_per_month),
            'number_of_months' => $contracts->contract_rentals?->installment->installment_name,
            'total_rental' => formatNumber($contracts->contract_rentals?->rent_receivable_per_annum),
            'plot_no' => $contracts->property?->plot_no,
            'renewal_status' => ($contracts->parent_contract_id == null) ? 'New' : 'Renewed',
            'renewal_number' => $contracts->renewal_count,

            'unit_details' => $contracts->contract_unit_details,
            'contract_payment_details' => $contracts->contract_payment_details,
            'contract_payment_receivables' => $contracts->contract_payment_receivables,
        ];
    }

    public function title(): string
    {
        return 'Project Scope';
    }

    public function array(): array
    {
        // Return only table rows for Excel
        return array_map(function ($row) {
            return [
                $row['property_name'],
            ];
        }, $this->data);
    }

    public function headings(): array
    {
        // Empty rows for title handled in styles
        return [
            [],
            [],
            [],
            [],
            []
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Guard: if $sheet is not available, bail out to avoid "Undefined variable '$sheet'" errors.
        if (!isset($sheet)) {
            return [];
        }

        if (count($this->data) > 0) {
            // Sheet title
            $contract = $this->data[0];
            $title = "Project {$contract['project_number']} {$contract['property_name']}, {$contract['area']}, {$contract['locality']} ({$contract['vendor_name']}) Contract Period: {$contract['start_date']} to {$contract['end_date']}";

            $headerStyle = [
                'font' => [
                    'bold' => true,
                    'size' => 11,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['rgb' => '1F4E78'],
                ],
            ];

            $centerAlign = [
                'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
            ];

            $leftAlign = [
                'alignment' => ['horizontal' => 'left', 'vertical' => 'center'],
            ];

            $fontBold = [
                'font' => ['bold' => true],
            ];

            // Apply to A1:J1
            $sheet->mergeCells('A1:J1');
            $sheet->setCellValue('A1', $title);
            $sheet->getStyle('A1')->applyFromArray($headerStyle);


            // Left scope summary
            $summaryArr = [
                ['Building Name', '', $contract['property_name'], '', '', '', 'OTC', '', 'Furniture', ''],
                ['Number of Houses', '', $contract['total_units'], '', '', '', 'Cost of Development', '', $contract['cost_of_development'], ''],
                ['Vendor Name', '', $contract['vendor_name'], '', '', '', 'Cost of Beds', '', $contract['cost_of_beds'], ''],
                ['Total Contract Amt', '', $contract['total_contract_amount'], '', '', '',  'Cost of Mattresses', '', $contract['cost_of_mattresses'], ''],
                ['Unit Type', '', $contract['unit_type'], '', '', '', 'Cost of Cabinets', '', $contract['cost_of_cabinets'], ''],
                ['Grace Period', '', $contract['grace_period'], '', '', '',  'Appliances', '', $contract['appliances'], ''],
                ['Commission', '', $contract['commission'], '', '', '',  'Decoration', '', $contract['decoration'], ''],
                ['Contract Fee', '', $contract['contract_fee'], '', '', '',  'Dewa Deposit', '', $contract['dewa_deposit'], ''],
                ['Refundable Deposit', '', $contract['refundable_deposit'], '', '', '',  'Total OTC', '', $contract['total_otc'], ''],
                ['Total Payment to Vendor', '', $contract['total_payment_to_vendor'], '', '', '',  'Expected Rental', '', $contract['expected_rental'], ''],
                ['Total OTC', '', $contract['total_otc'], '', '', '', 'Number of Months', '', $contract['number_of_months'], ''],
                ['Final Cost', '', $contract['final_cost'], '', '', '', 'Total Rental', '', $contract['total_rental'], ''],
                ['Initial Investment', '', $contract['initial_investment'], '', '', '',  'Plot Number', '', $contract['plot_no'], ''],
                ['Expected Profit', '', $contract['expected_profit'], '', '', '',  'Renewal Status', '', $contract['renewal_status'], ''],
                ['ROI', '', $contract['roi'], '', '', '', 'Renewal Number', '', $contract['renewal_number'], ''],
            ];

            // Write the array starting at row 2
            $sheet->fromArray($summaryArr, null, 'A2');

            // Apply style for all rows in the summary table
            $lastSummRow = 2 + count($summaryArr) - 1;

            // Merge the third value (column C) across C, D, E for each row
            foreach ($summaryArr as $i => $row) {
                $currentRow = $i + 2; // because array starts at row 2
                // Merge columns C (3), D (4), E (5) for this row
                $sheet->mergeCells("C{$currentRow}:E{$currentRow}");
                $sheet->mergeCells("F{$currentRow}:F{$lastSummRow}");
                $sheet->mergeCells("G{$currentRow}:H{$currentRow}");
                $sheet->mergeCells("I{$currentRow}:J{$currentRow}");

                if ($currentRow >= 14) {
                    $sheet->getStyle("G{$currentRow}:J{$currentRow}")->applyFromArray([
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'color' => ['rgb' => 'D9D9D9'], // background color (blue)
                        ],
                    ]);
                } else {
                    $sheet->getStyle("A{$currentRow}:J" . $lastSummRow)->applyFromArray([
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'color' => ['rgb' => 'F8CBAD'],
                        ],
                    ]);
                }
            }


            $sheet->getStyle('A2:J' . $lastSummRow)->applyFromArray([
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => 'left', 'vertical' => 'center'],
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
            ]);



            // unit detail section
            $subunitCount = $total_per_contract = $rentAnnum = [];
            foreach ($contract['unit_details'] as $key => $unitdetail) {

                $subunitdet = getAccommodationDetails($unitdetail);

                if ($key == 0)
                    $unitDetaiArr[] = ['Type', 'Room', 'Rent', $subunitdet['title'], $subunitdet['price_title'], 'Total'];


                $unitDetaiArr[] = [
                    $unitdetail->unit_type->unit_type ?? '',
                    $unitdetail->unit_number ?? '',
                    $unitdetail->unit_rent_per_annum ?? 0,
                    $subunitdet['accommodation'],
                    $subunitdet['price'],
                    $subunitdet['total_price'],
                ];
                $subunitCount[] = $subunitdet['accommodation'];
                $total_per_contract[] = $subunitdet['total_price'];
                $rentAnnum[] = toNumeric($unitdetail->unit_rent_per_annum);
            }

            $unitDetaiArr[] = [];
            $unitDetaiArr[] = [];

            $unitDetaiArr[] = ['', '', array_sum($rentAnnum), array_sum($subunitCount), '', array_sum($total_per_contract)];
            $unitDetaiArr[] = ['', '', array_sum($rentAnnum) / 4, '', '', ''];
            $unitDetaiArr[] = ['', '', array_sum($rentAnnum) * 0.1, '', '', ''];

            // Write the array starting at row 4, column K
            $sheet->fromArray($unitDetaiArr, null, 'K4');

            // Calculate the last row
            $lastRow = 4 + count($unitDetaiArr) - 1;

            // 🔹 Apply style for entire table (borders, fill, alignment)
            $sheet->getStyle("K4:P" . ($lastRow - 2))->applyFromArray([
                'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                'borders' => ['allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ]],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['rgb' => '9BC2E6'],
                ],
            ]);

            // 🔹 Make header row (only first row) bold
            $sheet->getStyle('K4:P4')->getFont()->setBold(true);

            $sheet->getStyle("K" . ($lastRow - 3) . ":P" . ($lastRow - 1))
                ->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_NONE,
                        ],
                    ],
                ]);


            $sheet->getStyle("K" . ($lastRow - 2) . ":P" . ($lastRow - 2))
                ->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => 'FFC000', // yellow
                        ],
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_NONE,
                        ],
                    ],
                ]);

            $sheet->getStyle("K" . ($lastRow - 1) . ":P" . $lastRow)
                ->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_NONE,
                        ],
                    ],
                    'font' => [
                        'color' => [
                            'argb' => 'D0CECE', // black text color
                        ],
                    ],

                ]);



            // Apply to A18:J18
            $sheet->mergeCells('A18:J18');
            $sheet->setCellValue('A18', $title);
            $sheet->getStyle('A18')->applyFromArray($headerStyle);

            // Left scope payables
            $payableArr = [
                ['SN', 'Description', '', 'Total Payables in AED'],
                ['', '', '', ''],
                ['1', 'Rental', '', $contract['total_contract_amount']],
                ['2', 'Ref.Deposit', '', $contract['refundable_deposit']],
                ['3', 'Commission', '', $contract['commission']],
                ['4', 'OTC', '', $contract['total_otc']],
                ['5', 'Contractor fee', '', $contract['contract_fee']],
                ['6', '', '', ''],
                ['7', '', '', ''],
                ['8', '', '', ''],
                ['9', '', '', ''],
                ['10', '', '', ''],
                ['11', '', '', ''],
                ['12', '', '', ''],
                ['', '', '', ''],
                ['', '', '', ''],
                ['', '', '', ''],
                ['', '', '', ''],

            ];

            // Write the array starting at row 2
            $sheet->fromArray($payableArr, null, 'A19');

            // Apply style for all rows in the summary table
            $lastPayableRow = 2 + count($payableArr) - 1;

            $sheet->mergeCells("A19:A20");
            $sheet->mergeCells("B19:C20");
            $sheet->mergeCells("D19:D20");

            $sheet->getStyle('A19:D20')->applyFromArray([
                'font' => [
                    'bold' => true,
                ],
            ]);

            // Merge the third value (column C) across C, D, E for each row
            foreach ($payableArr as $i => $row) {
                $currentRow = $i + 19; // because array starts at row 2
                // Merge columns C (3), D (4), E (5) for this row
                $sheet->mergeCells("B{$currentRow}:C{$currentRow}");
            }

            $sheet->getStyle("A19:C35")->applyFromArray([
                'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                'borders' => ['allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ]],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['rgb' => 'F8CBAD'], // background color (blue)
                ],
            ]);

            $sheet->getStyle("D19:D35")->applyFromArray([
                'alignment' => ['horizontal' => 'right', 'vertical' => 'center'],
                'borders' => ['allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ]],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['rgb' => 'F8CBAD'], // background color (blue)
                ],
            ]);
            $sheet->getStyle("D19:D35")
                ->getNumberFormat()
                ->setFormatCode(NumberFormat::FORMAT_NUMBER_00);



            // Left scope payables
            $installmentDet = $arrayofPayable = [];
            foreach ($contract['contract_payment_details'] as $key => $paymentDet) {
                $arrayofPayable[] = toNumeric($paymentDet->payment_amount);

                $installmentDet[] = [
                    paymentDetailScope($paymentDet),
                    DateTime::createFromFormat('d-m-Y', $paymentDet->payment_date)->format('d-M-Y'),
                    formatNumber($paymentDet->payment_amount)
                ];
            }


            $payableInstallmentsArr = [
                ['Payment to vendor', '', ''],
                ['Bank & Cheque number', 'Date', 'AED'],
            ];
            $payableDetArr = array_merge($payableInstallmentsArr, $installmentDet);

            // Write the array starting at row 2
            $sheet->fromArray($payableDetArr, null, 'E19');

            $sheet->mergeCells("E19:G19");
            $sheet->getStyle('E19:G20')->applyFromArray([
                'font' => [
                    'bold' => true,
                ],
            ]);

            $sheet->getStyle("E19:G35")->applyFromArray([
                'alignment' => ['horizontal' => 'right', 'vertical' => 'center'],
                'borders' => ['allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ]],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['rgb' => 'B4C6E7'], // background color (blue)
                ],
            ]);
            $sheet->getStyle("E19:G35")
                ->getNumberFormat()
                ->setFormatCode(NumberFormat::FORMAT_NUMBER_00);



            // Left scope payables
            $installmentRec = $arrayofRec = [];
            foreach ($contract['contract_payment_receivables'] as $key => $paymentRec) {
                $arrayofRec[] = toNumeric($paymentRec->receivable_amount);
                $installmentRec[] = [
                    DateTime::createFromFormat('d-m-Y', $paymentRec->receivable_date)->format('d-M-Y'),
                    formatNumber($paymentRec->receivable_amount)
                ];
            }


            $payableRecArr = [
                ['Receivables from  - Cheques details', '', ''],
                ['Date', 'AED', 'Actual Receipts'],
            ];
            $receivableDetArr = array_merge($payableRecArr, $installmentRec);

            // Write the array starting at row 2
            $sheet->fromArray($receivableDetArr, null, 'H19');

            $sheet->mergeCells("H19:J19");
            $sheet->getStyle('H19:J20')->applyFromArray([
                'font' => [
                    'bold' => true,
                ],
            ]);

            $sheet->getStyle("H19:J35")->applyFromArray([
                'alignment' => ['horizontal' => 'right', 'vertical' => 'center'],
                'borders' => ['allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ]],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['rgb' => 'C6E0B4'], // background color (blue)
                ],
            ]);



            $sheet->getStyle("E19:J20")->applyFromArray($centerAlign);
            $sheet->getStyle("E19:J20")->applyFromArray($centerAlign);
            $sheet->getStyle("E21:F35")->applyFromArray($centerAlign);
            $sheet->getStyle("E21:F35")->applyFromArray($centerAlign);
            $sheet->getStyle("H21:H35")->applyFromArray($centerAlign);

            $sheet->getStyle("H19:J35")
                ->getNumberFormat()
                ->setFormatCode(NumberFormat::FORMAT_NUMBER_00);

            $totalArr = [
                ['Total', '', '', $contract['final_cost'], '', '', array_sum($arrayofPayable), '', array_sum($arrayofRec), '0.00'],
                ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            ];

            $sheet->fromArray($totalArr, null, 'A36');
            // dd($fontBold);
            $sheet->mergeCells("A36:C36");
            $sheet->getStyle("A36:C36")->applyFromArray(array_merge_recursive([
                $leftAlign,
                'font' => [
                    'bold' => true,
                ],
                'borders' => ['allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ]],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['rgb' => 'FFFF00'], // background color (Yellow)
                ],
            ]));
            $sheet->getStyle('D36:J36')->applyFromArray(array_merge_recursive([
                'alignment' => ['horizontal' => 'right', 'vertical' => 'center'],
                'font' => [
                    'bold' => true,
                ],
                'borders' => ['allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ]],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['rgb' => 'FFFF00'], // background color (Yellow)
                ],
            ]));
        }



        // Data borders
        $lastSheetRow = 3 + count($this->array());
        $sheet->getStyle('A4:F' . $lastSheetRow)->applyFromArray([
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
        ]);

        return [];
    }
}
