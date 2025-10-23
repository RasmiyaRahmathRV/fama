<?php

namespace App\Repositories\Contracts;

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
        return Contract::create($data);
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
        $query = Contract::query()
            ->select([
                'contracts.*',
                'properties.property_name',
                'vendors.vendor_name',
                'contract_details.start_date',
                'contract_details.end_date',
                'companies.company_name'
            ])
            ->join('contract_details', 'contract_details.contract_id', '=', 'contracts.id')
            ->join('properties', 'properties.id', '=', 'contracts.property_id')
            ->join('vendors', 'vendors.id', '=', 'contracts.vendor_id')
            ->join('companies', 'companies.id', '=', 'contracts.company_id')
            ->join('contract_types', 'contract_types.id', '=', 'contracts.contract_type_id');

        if (!empty($filters['search'])) {
            $query->orwhere('project_code', 'like', '%' . $filters['search'] . '%')
                ->orWhere('project_number', 'like', '%' . $filters['search'] . '%')

                ->orWhereHas('company', function ($q) use ($filters) {
                    $q->where('company_name', 'like', '%' . $filters['search'] . '%');
                })
                ->orWhereHas('vendor', function ($q) use ($filters) {
                    $q->where('vendor_name', 'like', '%' . $filters['search'] . '%');
                })
                ->orWhereHas('contract_type', function ($q) use ($filters) {
                    $q->where('contract_type', 'like', '%' . $filters['search'] . '%');
                })
                ->orWhereHas('locality', function ($q) use ($filters) {
                    $q->where('locality_name', 'like', '%' . $filters['search'] . '%');
                })
                ->orWhereHas('property', function ($q) use ($filters) {
                    $q->where('property_name', 'like', '%' . $filters['search'] . '%');
                })
                ->orWhereRaw("CAST(contracts.id AS CHAR) LIKE ?", ['%' . $filters['search'] . '%']);
        }



        if (!empty($filters['company_id'])) {
            $query->Where('contracts.company_id', $filters['company_id']);
        }

        return $query;
    }
}
