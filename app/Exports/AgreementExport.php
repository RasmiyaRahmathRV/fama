<?php

namespace App\Exports;

use App\Models\Agreement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AgreementExport implements FromCollection, WithHeadings
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
        $query = Agreement::with(
            'company',
            'contract',
            'tenant',
            'agreement_units.contractUnitDetail',
            'contract.contract_type'
        );

        if ($this->search) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {

                $q->orwhere('agreement_code', 'like', "%{$search}%")
                    ->orWhereHas('contract', function ($q) use ($search) {
                        $q->where('project_number', 'like', "%{$search}%");
                    })

                    ->orWhereHas('company', function ($q) use ($search) {
                        $q->where('company_name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('contract.contract_type', function ($q) use ($search) {
                        $q->where('contract_type', 'like', "%{$search}%");
                    })
                    ->orWhereHas('tenant', function ($q) use ($search) {
                        $q->where('tenant_name', 'like', "%{$search}%")
                            ->orWhere('tenant_email', 'like', "%{$search}%")
                            ->orWhere('tenant_mobile', 'like', "%{$search}%");
                    })
                    ->orWhereRaw("CAST(agreements.id AS CHAR) LIKE ?", ["%{$search}%"]);
            });
        }

        if ($this->filter) {
            $query->where('agreements.id', $this->filter);
        }
        // dd($query->get()->toArray());
        return $query->get()
            ->map(function ($agreement) {
                // $collection = $query->get()->map(function ($agreement) {
                $unitNumbers = $agreement->agreement_units
                    ->map(fn($au) => optional($au->contractUnitDetail)->unit_number)
                    ->filter()
                    ->implode(', ');
                // $totalRevenue = $agreement->agreement_units
                //     ->sum(fn($au) => optional($au->contractUnitDetail)->unit_revenue);
                return [
                    'Project ID' => "P - " . $agreement->contract->project_number,
                    'Agreemant CODE' => $agreement->agreement_code,
                    'Contract Type' => $agreement->contract->contract_type->contract_type,
                    'Business Type' => $agreement->contract->contract_unit->business_type(),

                    'Start Date'  => $agreement->start_date,
                    'End Date'  => $agreement->end_date,
                    'Company Name' => $agreement->company->company_name,
                    'Tenant Name' => $agreement->tenant->tenant_name ?? '',
                    'Tenant Email' => $agreement->tenant->tenant_email ?? '',
                    'Tenant Phone' => $agreement->tenant->tenant_mobile ?? '',
                    'Unit Numbers' => $unitNumbers ?: '-',
                    'Total Rent Annum' => $agreement->agreement_payment->total_rent_annum ?? '',
                    'Created_at' => $agreement->created_at,


                ];
            });
        // dd($collection);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Agreement CODE',
            'Contact Type',
            'Business Type',
            'Start Date',
            'End Date',
            'Company Name',
            'Tenant Name',
            'Tenant Email',
            'Tenant Phone',
            'Unit Numbers',
            'Total Rent Annum',
            'Created_at',
        ];
    }
}
