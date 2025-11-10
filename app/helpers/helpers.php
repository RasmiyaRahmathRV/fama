<?php

use App\Models\Installment;

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
    if (array_key_exists('partition', $dataArr) && isset($dataArr['partition'][$key])) {
        if ($dataArr['partition'][$key] == 1) {
            $partition = 1;
            $rent_per_unit_per_month = $dataArr['rent_per_partition'];
        } else if ($dataArr['partition'][$key] == 2) {
            $bedspace = 1;
            $rent_per_unit_per_month = $dataArr['rent_per_bedspace'];
        } else {
            $room = 1;
            $rent_per_unit_per_month = $dataArr['rent_per_room'];
        }
    } else {
        $rent_per_unit_per_month = $dataArr['rent_per_flat'];
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
        'rent_per_unit_per_annum' => $rent_per_unit_per_annum
    );
    // dd($retData);
    return $retData;
}
