<?php

namespace App\Services\Contracts;

use App\Models\Contract;

class DirectScopeDataService
{
    public static function getContractData($contractId)
    {
        $contract = Contract::with([
            'contract_unit',
            'contract_rentals',
            'contract_detail',
            'contract_otc',
            'contract_payments',
            'contract_payment_details',
            'contract_unit_details',
            'contract_payment_receivables',
            'vendor',
        ])
            ->whereIn('contract_status', [0, 1])
            ->find($contractId);

        if (!$contract) {
            return [];
        }

        return [
            'project_number' => $contract->project_number ?? '',
            'property_name' => $contract->property?->property_name ?? '',
            'area' => $contract->area?->area_name ?? '',
            'locality' => $contract->locality?->locality_name ?? '',
            'vendor_name' => $contract->vendor?->vendor_name ?? '',
            'start_date' => $contract->contract_detail?->start_date ?? '',
            'end_date' => $contract->contract_detail?->end_date ?? '',
            'total_units' => $contract->contract_unit?->no_of_units ?? 0,
            'total_contract_amount' => formatNumber($contract->contract_rentals?->rent_per_annum_payable),
            'unit_type' => $contract->contract_unit?->unit_type_count,


            'grace_period' => $contract->contract_detail?->grace_period,
            'commission' => formatNumber($contract->contract_rentals?->commission),
            'contract_fee' => formatNumber($contract->contract_detail?->contract_fee),
            'refundable_deposit' => formatNumber($contract->contract_rentals?->deposit),
            'total_payment_to_vendor' => formatNumber($contract->contract_rentals?->total_payment_to_vendor),
            'total_otc' => formatNumber($contract->contract_rentals?->total_otc),
            'final_cost' => formatNumber($contract->contract_rentals?->final_cost),
            'initial_investment' => formatNumber($contract->contract_rentals?->initial_investment),
            'expected_profit' => formatNumber($contract->contract_rentals?->expected_profit),
            'roi' => $contract->contract_rentals?->roi_perc,
            'profit_percentage' => $contract->contract_rentals?->profit_percentage,


            'cost_of_development' => formatNumber($contract->contract_otc?->cost_of_development),
            'cost_of_beds' => formatNumber($contract->contract_otc?->cost_of_bed),
            'cost_of_mattresses' => formatNumber($contract->contract_otc?->cost_of_matress),
            'cost_of_cabinets' => formatNumber($contract->contract_otc?->cost_of_cabinets),
            'appliances' => formatNumber($contract->contract_otc?->appliances),
            'decoration' => formatNumber($contract->contract_otc?->decoration),
            'dewa_deposit' => formatNumber($contract->contract_otc?->dewa_deposit),


            'expected_rental' => formatNumber($contract->contract_rentals?->rent_receivable_per_month),
            'number_of_months' => $contract->contract_rentals?->installment->installment_name,
            'total_rental' => formatNumber($contract->contract_rentals?->rent_receivable_per_annum),
            'plot_no' => $contract->property?->plot_no,
            'renewal_status' => $contract->parent_contract_id ? 'Renewed' : 'New',
            'renewal_number' => $contract->renewal_count,
            'unit_details' => $contract->contract_unit_details,
            'contract_payment_details' => $contract->contract_payment_details,
            'contract_payment_receivables' => $contract->contract_payment_receivables,
        ];
    }
}
