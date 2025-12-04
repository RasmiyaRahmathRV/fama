<?php

use App\Models\Agreement;
use App\Models\AgreementPaymentDetail;
use App\Models\Contract;
use App\Models\ContractSubunitDetail;
use App\Models\ContractUnitDetail;
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

    if ($installment->installment_name == '14') {
        $installment = '13';
    } else {
        $installment = $installment->installment_name;
    }

    if (isset($dataArr['unit_profit'])) {
        // print('profit');
        $rent_per_flat = $dataArr['unit_revenue'][$key] / $installment;
        $rent_per_unit_per_month = $rent_per_flat;
        $subunit_rent_per_unit = $rent_per_flat;
        $total_rent_per_unit_per_month  = $rent_per_flat;
    }
    // print($rent_per_unit_per_month);

    $rent_per_unit_per_annum = $rent_per_unit_per_month * $installment;

    $total_rent_per_unit_per_annum = $total_rent_per_unit_per_month * $installment;

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
        'total_rent_per_unit_per_month' => $total_rent_per_unit_per_month,
        'total_rent_per_unit_per_annum' => $total_rent_per_unit_per_annum
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
function getOccupiedDetails($unitId)
{
    $totalSubunits = ContractSubunitDetail::where('contract_unit_detail_id', $unitId)->count();
    $OccupiedSubunitCount = ContractSubunitDetail::where('contract_unit_detail_id', $unitId)
        ->where('is_vacant', 1)
        ->count();

    $VacantSubunitCount = $totalSubunits - $OccupiedSubunitCount;
    return [
        'occupied' => $OccupiedSubunitCount,
        'vacant' => $VacantSubunitCount,
        'totalsubunits' => $totalSubunits
    ];
}
function getPaymentDetails($paymentId, $unitId)
{
    $payment_details = AgreementPaymentDetail::where('agreement_payment_id', $paymentId)
        ->where('contract_unit_id', $unitId)
        ->where('terminate_status', 0);
    $totalPaidAmount = $payment_details->sum('paid_amount');
    $totalPaymentAmount = $payment_details->sum('payment_amount');
    $pendingAmount = $totalPaymentAmount - $totalPaidAmount;
    return [
        'received' => $totalPaidAmount,
        'pending' => $pendingAmount,
        'total' => $totalPaymentAmount
    ];
}
function makeUnitVacant($unitId, $contract_id)
{
    $unit = ContractUnitDetail::find($unitId);
    if ($unit) {
        $unit->is_vacant = 0;
        $unit->save();
    }
    $subunit = ContractSubunitDetail::where('contract_unit_detail_id', $unitId)->get();
    foreach ($subunit as $sub) {
        $sub->is_vacant = 0;
        $sub->save();
    }
}
function getVacantUnits($id)
{
    $unit_count = ContractUnitDetail::where('contract_id', $id)->where('is_vacant', 0)->count();
    return $unit_count;
}
function paymentStatus($agreementid)
{
    $paid = AgreementPaymentDetail::where('agreement_id', $agreementid)
        ->where('terminate_status', 0)
        ->SUM('paid_amount');
    // dd($paid);

    return $paid;
}
function makeContractAvailable($contract_id)
{
    $contract = Contract::find($contract_id);
    $contract->is_agreement_added = 0;
    $hasagreement = Agreement::where('contract_id', $contract_id)->exists();
    if (!$hasagreement) {
        $contract->has_agreement = 0;
    }
    $contract->save();
}
