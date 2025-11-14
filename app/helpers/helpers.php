<?php

use App\Exports\Styles\DirectScopeStyles;
use App\Models\Installment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

if (!function_exists('toNumeric')) {
    /**
     * Convert a mixed value (like "60,000.00" or "AED 5,500") to a clean float.
     */
    function toNumeric($value): float
    {
        if (is_null($value)) {
            return 0.0;
        }

        // Remove commas, currency symbols, and any non-numeric chars except dot and minus
        $cleaned = preg_replace('/[^\d.\-]/', '', $value);

        return (float) $cleaned;
    }
}


function subunitNoGeneration($subUnitData, $key, $i)
{
    // print_r($subUnitData);
    // dd('increement room no - ' . $i);
    if (isset($subUnitData['is_partition'][$key])) {
        if ($subUnitData['is_partition'][$key] == '1') {
            $subunitno = 'P' . $i;
        } else if ($subUnitData['is_partition'][$key] == '2') {
            $subunitno = 'BS' . $i;
        } else {
            $subunitno = 'R' . $i;
        }
    } else {
        $subunitno = 'FL' . $i;
    }

    return $subunitno;
}


function subUnitCount($subUnitData, $i)
{
    $subunitcount = 0;
    if (isset($subUnitData['is_partition'][$i])) {
        if ($subUnitData['is_partition'][$i] == '1') {
            $subunitcount = $subUnitData['partition'][$i];
        } else if ($subUnitData['is_partition'][$i] == '2') {
            $subunitcount = $subUnitData['bedspace'][$i];
        } else {
            $subunitcount = $subUnitData['room'][$i];
        }
    } else {
        $subunitcount++;
    }

    return $subunitcount;
}

function subUnitType($subUnitData, $i)
{
    $subunit_type = '0';
    if (isset($subUnitData['is_partition'][$i])) {
        if ($subUnitData['is_partition'][$i] == '1') {
            $subunit_type = '1';
        } else if ($subUnitData['is_partition'][$i] == '2') {
            $subunit_type = '2';
        } else {
            $subunit_type = '3';
        }
    } else {
        $subunit_type = '4';
    }

    return $subunit_type;
}

function getPartitionValue($dataArr, $key, $receivable_installments)
{
    $partition = 0;
    $bedspace = 0;
    $room = 0;
    $rent_per_unit_per_month = 0;
    $rent_per_unit_per_annum = 0;
    $subunittype = 0;
    $subunitcount_per_unit = 0;
    $subunit_rent_per_unit = 0;
    $total_rent_per_unit_per_month = 0;

    if (array_key_exists('partition', $dataArr) && isset($dataArr['partition'][$key])) {
        if ($dataArr['partition'][$key] == 1) {
            $partition = 1;
            $rent_per_unit_per_month = $dataArr['rent_per_partition'];
            $subunittype = 1;
            $subunitcount_per_unit += $dataArr['total_partition'][$key];
            $subunit_rent_per_unit = $dataArr['rent_per_partition'];
            $total_rent_per_unit_per_month = $dataArr['total_partition'][$key] * $dataArr['rent_per_partition'];
        } else if ($dataArr['partition'][$key] == 2) {
            $bedspace = 1;
            $rent_per_unit_per_month = $dataArr['rent_per_bedspace'];
            $subunittype = 2;
            $subunitcount_per_unit += $dataArr['total_bedspace'][$key];
            $subunit_rent_per_unit = $dataArr['rent_per_bedspace'];
            $total_rent_per_unit_per_month = $dataArr['total_bedspace'][$key] * $dataArr['rent_per_bedspace'];
        } else {
            $room = 1;
            $rent_per_unit_per_month = $dataArr['rent_per_room'];
            $subunittype = 3;
            $subunitcount_per_unit += $dataArr['total_room'][$key];
            $subunit_rent_per_unit = $dataArr['rent_per_room'];
            $total_rent_per_unit_per_month = $dataArr['total_room'][$key] * $dataArr['rent_per_room'];
        }
    } else {
        $rent_per_unit_per_month = $dataArr['rent_per_flat'];
        $subunittype = 4;
        $subunitcount_per_unit += 1;
        $subunit_rent_per_unit = $dataArr['rent_per_flat'];
        $total_rent_per_unit_per_month  = $dataArr['rent_per_flat'];
    }


    $rent_per_flat = $dataArr['rent_per_flat'];
    $installment = Installment::find($receivable_installments);
    if (isset($dataArr['unit_profit'])) {
        // print('profit');
        $rent_per_flat = $dataArr['unit_revenue'][$key] / $installment->installment_name;
        $rent_per_unit_per_month = $rent_per_flat;
    }
    // print($rent_per_unit_per_month);

    $rent_per_unit_per_annum = $rent_per_unit_per_month * $installment->installment_name;


    $retData = array(
        'partition' => $partition,
        'bedspace' => $bedspace,
        'room' => $room,
        'rent_per_flat' => $rent_per_flat,
        'rent_per_unit_per_month' => $rent_per_unit_per_month,
        'rent_per_unit_per_annum' => $rent_per_unit_per_annum,
        'subunittype' => $subunittype,
        'subunitcount_per_unit' => $subunitcount_per_unit,
        'subunit_rent_per_unit' => $subunit_rent_per_unit,
        'total_rent_per_unit_per_month' => $total_rent_per_unit_per_month
    );
    // dd($retData);
    return $retData;
}


function getAccommodationDetails($unitDetails)
{
    // dd($unitDetails);
    $accocmmodation = $title = $price_title = '';
    $total_price = $price = 0;

    if ($unitDetails->partition != null) {
        $title = 'Partition';
        $price_title = 'Per Partiton';
        $accocmmodation = $unitDetails->total_partition;
        $price = $unitDetails->rent_per_partition;
    } elseif ($unitDetails->bedspace != null) {
        $title = 'Bedspace';
        $price_title = 'Per Bedspace';
        $accocmmodation = $unitDetails->total_bedspace;
        $price = $unitDetails->rent_per_bedspace;
    } elseif ($unitDetails->room != null) {
        $title = 'Bedspace';
        $price_title = 'Per Bedspace';
        $accocmmodation = $unitDetails->total_room;
        $price = $unitDetails->rent_per_room;
    } else {
        $title = 'Full Flat';
        $price_title = 'Per Flat';
        $accocmmodation = 1;
        $price = $unitDetails->rent_per_flat;
    }

    $total_price = $unitDetails->total_rent_per_unit_per_month;

    $return = array(
        'title' => $title,
        'price_title' => $price_title,
        'accommodation' => $accocmmodation,
        'price' => $price,
        'total_price' => $total_price
    );

    return $return;
}

function formatNumber($number)
{
    return number_format(toNumeric($number), 2, '.', ',');
}

function paymentDetailScope($detail)
{
    // dd($detail);
    $modeReturn = '';
    if (in_array($detail->payment_mode_id, [1, 4])) {
        $modeReturn = $detail->payment_mode->payment_mode_name;
    } elseif ($detail->payment_mode_id == 2) {
        $modeReturn = $detail->bank->bank_name . ' - ' . $detail->payment_mode->payment_mode_name;
    } elseif ($detail->payment_mode_id == 3) {
        $modeReturn = $detail->bank->bank_name . ' - ' . $detail->cheque_no;
    }

    return $modeReturn;
}

function renderSummary($sheet, $contract, $title)
{
    // Example: add summary data to Excel
    $sheet->setCellValue('A1', $title);
    $sheet->mergeCells('A1:E1');
    $sheet->getStyle('A1')->getFont()->setBold(true);

    $summaryArr = [
        ['Building Name', '', $contract['property_name'], '', '', '', 'OTC', '', 'Furniture', ''],
        ['Number of Houses', '', $contract['total_units'] . ' Houses', '', '', '', 'Cost of Development', '', $contract['cost_of_development'], ''],
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
        ['ROI', '', $contract['roi'] . '%', '', '', '', 'Renewal Number', '', $contract['renewal_number'], ''],
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
}

function renderUnitDetails($sheet, $contract)
{
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
}

function renderPayables($sheet, $contract, $title)
{
    // Apply to A18:J18
    $sheet->mergeCells('A18:J18');
    $sheet->setCellValue('A18', $title);
    $sheet->getStyle('A18')->applyFromArray(DirectScopeStyles::header());

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
}


function renderPaymentToVendor($sheet, $contract)
{
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
}

function renderReceivables($sheet, $contract)
{
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

    $centerAlign = [
        'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
    ];



    $sheet->getStyle("E19:J20")->applyFromArray($centerAlign);
    $sheet->getStyle("E19:J20")->applyFromArray($centerAlign);
    $sheet->getStyle("E21:F35")->applyFromArray($centerAlign);
    $sheet->getStyle("E21:F35")->applyFromArray($centerAlign);
    $sheet->getStyle("H21:H35")->applyFromArray($centerAlign);

    $sheet->getStyle("H19:J35")
        ->getNumberFormat()
        ->setFormatCode(NumberFormat::FORMAT_NUMBER_00);
}

function renderTotal($sheet, $contract)
{
    $leftAlign = [
        'alignment' => ['horizontal' => 'left', 'vertical' => 'center'],
    ];

    $totalArr = [
        ['Total', '', '', $contract['final_cost'], '', '', $contract['total_payment_to_vendor'], '', $contract['total_rental'], '0.00'],
        ['Profit Margin', '', '', '', '', '', '', '', $contract['expected_profit'], ''],
    ];

    $sheet->fromArray($totalArr, null, 'A36');
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


    $sheet->mergeCells("A37:H37");
    $sheet->getStyle("A37:J37")->applyFromArray(array_merge_recursive([
        'alignment' => ['horizontal' => 'right', 'vertical' => 'center'],
        'font' => [
            'bold' => true,
        ],
        'borders' => ['allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
        ]],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'color' => ['rgb' => 'F8CBAD'], // background color (Yellow)
        ],
    ]));

    $totalArr = [
        ['Profit%', $contract['profit_percentage'] . '%'],
    ];

    $sheet->fromArray($totalArr, null, 'H38');
    $sheet->getStyle("H38:I38")->applyFromArray(array_merge_recursive([
        'alignment' => ['horizontal' => 'right', 'vertical' => 'center'],
        'font' => [
            'bold' => true,
        ],
        'borders' => ['allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
        ]],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'color' => ['rgb' => 'F4B084'], // background color (Yellow)
        ],
    ]));

    $totalotc = [[(toNumeric($contract['total_otc']) / 2)],];
    $sheet->fromArray($totalotc, null, 'L36');
    $sheet->getStyle('L36:L36')->applyFromArray(array_merge_recursive([
        'alignment' => ['horizontal' => 'right', 'vertical' => 'center'],
        'font' => [
            'bold' => true,
            'color' => ['rgb' => 'FF0000'],
        ],
    ]));
}
