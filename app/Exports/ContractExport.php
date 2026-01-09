<?php

namespace App\Exports;

use App\Models\Contract;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContractExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */



    public function __construct(
        protected $search = null,
        protected $filter = null,
    ) {}

    public function collection()
    {
        $query = Contract::with('company', 'vendor', 'contract_type',);

        if ($this->search) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {

                $q->where('project_code', 'like', "%{$search}%")
                    ->orWhere('project_number', 'like', "%{$search}%")
                    ->orWhereHas('company', function ($q) use ($search) {
                        $q->where('company_name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('vendor', function ($q) use ($search) {
                        $q->where('vendor_name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('contract_type', function ($q) use ($search) {
                        $q->where('contract_type', 'like', "%{$search}%");
                    })
                    ->orWhereHas('locality', function ($q) use ($search) {
                        $q->where('locality_name',  'like', "%{$search}%");
                    })
                    ->orWhereHas('property', function ($q) use ($search) {
                        $q->where('property_name',  'like', "%{$search}%");
                    })
                    ->orWhereRaw("CAST(contracts.id AS CHAR) LIKE ?", ["%{$search}%"]);
            });
        }

        if ($this->filter) {
            $query->where('contracts.id', $this->filter);
        }
        return $query->get()
            ->map(function ($contract) {
                return [
                    'Project ID' => "P - " . $contract->project_number,
                    'Project CODE' => $contract->project_code,
                    'Contract Type' => $contract->contract_type->contract_type,
                    'Business Type' => match ($contract->contract_unit->business_type) {
                        1 => "B2B",
                        2 => "B2C"
                    },
                    'Start Date'  => $contract->contract_detail->start_date,
                    'End Date'  => $contract->contract_detail->end_date,
                    'Company Name' => $contract->company->company_name,
                    'Vendor Name' => $contract->vendor->vendor_name,
                    'Buliding' => $contract->property->property_name,
                    'Locality' => $contract->locality->locality_name ?? '',
                    'Unit' => $contract->contract_unit->unit_numbers ?? '',
                    'Commission' => $contract->contract_rentals->commission ?? '',
                    'Deposit' => $contract->contract_rentals->deposit,
                    'Rent Per Annum' => $contract->contract_rentals->rent_per_annum_payable,
                    'Total Vendor Payment' => $contract->contract_rentals->total_payment_to_vendor,
                    'Total OTC' => $contract->contract_rentals->total_otc,
                    'Total Project Cost' => $contract->contract_rentals->final_cost ?? '',
                    'Total Vendor Payment' => $contract->contract_rentals->total_payment_to_vendor,
                    'Tenure' => $contract->contract_detail->duration_in_months . "M",
                    'Rent Receivable per Annum' => $contract->contract_rentals->rent_receivable_per_annum,
                    'Rent Receivable per Month' => $contract->contract_rentals->rent_receivable_per_month,

                    'Status' => match ($contract->contract_renewal_status) {
                        0 => 'New',
                        1 => 'Renewal',
                    },
                    'Project Status' => match ($contract->contract_renewal_status) {
                        0 => 'New',
                        1 => 'Renewal (' . ($contract->renewal_count ?? 0) . ')',
                    },

                    'Created_at' => $contract->created_at->format('d/m/Y'),


                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Project CODE',
            'Contact Type',
            'Business Type',
            'Start Date',
            'End Date',
            'Company Name',
            'Vendor Name',
            'Buliding',
            'Locality',
            'Unit',
            'Commission',
            'Deposit',
            'Rent Per Annum',
            'Total Vendor Payment',
            'Total OTC',
            'Total Project Cost',
            'Tenure',
            'Rent Receivable per Annum',
            'Rent Receivable per Month',
            'Status',
            'Project Status',
            'Created_at',
        ];
    }
}
