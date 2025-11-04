<?php

namespace App\Repositories\Agreement;

use App\Models\Agreement;
use App\Models\Contract;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class AgreementRepository
{
    public function all()
    {
        return Contract::all();
    }

    public function find($id)
    {

        return Contract::with(
            'contract_detail',
            'contract_rentals',
            'contract_documents',
            'contract_otc',
            'contract_payments.contractPaymentDetails.payment_mode',
            'contract_payments.contractPaymentDetails.bank',
            'contract_payments.installment',
            'contract_unit.contractUnitDetails.contractSubUnitDetails',
            'contract_unit_details.property_type',
            'contract_unit_details.unit_type',
            'contract_unit_details.unit_status',
            'company',
            'area',
            'locality',
            'vendor',
            'property',
            'contract_type'
        )->findOrFail($id);
    }

    public function findId($data)
    {
        return Contract::where($data)->first();
    }

    public function create(array $data)
    {
        // dd($data);
        return Agreement::create($data);
    }

    public function update($id, array $data)
    {
        $contract = $this->find($id);
        $contract->update($data);
        return $contract;
    }
    public function delete($id)
    {
        $contract = $this->find($id);
        $contract->deleted_by = auth()->user()->id;
        $contract->save();
        return $contract->delete();
    }

    // public function checkIfExist($data)
    // {
    //     $existing = Contract::withTrashed()
    //         ->where('contract_name', $data['contract_name'])
    //         ->first();

    //     if ($existing && $existing->trashed()) {
    //         // $existing->restore();
    //         return $existing;
    //     }
    // }

    public function getQuery(array $filters = []): Builder
    {
        $query = Agreement::query()
            ->select([
                'agreements.*',
                'contracts.project_number',
                'companies.company_name',
                'agreement_tenants.tenant_name',
                'agreement_tenants.tenant_email',
                'agreement_tenants.tenant_mobile',
                'contract_types.contract_type'

            ])
            ->join('contracts', 'contracts.id', '=', 'agreements.contract_id')
            ->join('properties', 'properties.id', '=', 'contracts.property_id')
            // ->join('vendors', 'vendors.id', '=', 'contracts.vendor_id')
            ->join('companies', 'companies.id', '=', 'agreements.company_id')
            ->join('agreement_tenants', 'agreement_tenants.agreement_id', '=', 'agreements.id')
            ->join('contract_types', 'contract_types.id', '=', 'contracts.contract_type_id');
        // $get = $query->get();
        // dd($get);

        if (!empty($filters['search'])) {
            $query->orwhere('agreement_code', 'like', '%' . $filters['search'] . '%')
                ->orWhere('project_number', 'like', '%' . $filters['search'] . '%')

                ->orWhereHas('company', function ($q) use ($filters) {
                    $q->where('company_name', 'like', '%' . $filters['search'] . '%');
                })
                ->orWhereHas('contract.contract_type', function ($q) use ($filters) {
                    $q->where('contract_type', 'like', '%' . $filters['search'] . '%');
                })
                ->orWhereHas('tenant', function ($q) use ($filters) {
                    $q->where('tenant_name', 'like', '%' . $filters['search'] . '%')
                        ->orWhere('tenant_email', 'like', '%' . $filters['search'] . '%')
                        ->orWhere('tenant_mobile', 'like', '%' . $filters['search'] . '%');
                })
                // ->orWhereHas('contract_type', function ($q) use ($filters) {
                //     $q->where('contract_type', 'like', '%' . $filters['search'] . '%');
                // })

                ->orWhereRaw("CAST(contracts.id AS CHAR) LIKE ?", ['%' . $filters['search'] . '%']);
        }





        // if (!empty($filters['company_id'])) {
        //     $query->Where('contracts.company_id', $filters['company_id']);
        // }

        $query->orderBy('agreements.id', 'desc');

        return $query;
    }
}
