<?php

namespace App\Repositories\Agreement;

use App\Models\Agreement;
use App\Models\AgreementUnit;
use App\Models\Contract;
use App\Models\ContractSubunitDetail;
use App\Models\ContractUnitDetail;
use App\Repositories\Contracts\ContractRepository;
use App\Services\Agreement\AgreementPaymentDetailService;
use App\Services\Agreement\AgreementPaymentService;
use App\Services\Agreement\AgreementTenantService;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class AgreementRepository
{
    public function __construct(
        protected ContractRepository $contractRepository,


    ) {}
    public function all()
    {
        return Agreement::all();
    }

    public function find($id)
    {

        return Agreement::with(
            'contract',
            'company',
            'tenant.nationality',
            'agreement_payment.agreementPaymentDetails',
            'agreement_documents',
            'agreement_units.contractSubunitDetail',
            'agreement_units.contractUnitDetail'


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
        $agreement = $this->find($id);
        $agreement->update($data);
        return $agreement;
    }
    public function delete($id)
    {
        $agreement = $this->find($id);
        $agreement->deleted_by = auth()->user()->id;
        $agreement->save();
        $contract_id = $agreement->contract_id;
        $this->makeVacant($id, $contract_id);
        return $agreement->delete();
    }



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
    public function findunits($id)
    {
        return Agreement::find($id)
            ->agreement_units()
            ->pluck('id')
            ->toArray();
    }
    public function getDetails($id)
    {

        return Agreement::with([
            'contract' => function ($query) {
                $query->with(['vendor', 'area', 'property', 'locality', 'contract_rentals', 'contract_type']);
            },
            'company',
            'tenant.nationality',
            'agreement_payment.agreementPaymentDetails',
            'agreement_payment.installment',
            'agreement_documents',
            'agreement_units.contractSubunitDetail',
            'agreement_units.contractUnitDetail.unit_type'
        ])->findOrFail($id);
    }
    public function makeVacant($agreementid, $contractid)
    {
        $contract = $this->contractRepository->find($contractid);
        $type = $contract->contract_type_id;
        $business_type = $contract->contract_unit->business_type;
        // dd($type, $business_type);
        if ($type == 2 || ($type == 1 && $business_type == 1)) {
            $contract_units = $contract->contract_unit_details;
            foreach ($contract_units as $unit) {
                foreach ($unit->contractSubUnitDetails as $sub) {
                    $sub->is_vacant = 0;
                    $sub->save();
                }
                $unit->is_vacant = 0;
                $unit->save();
            }
            $contract->is_agreement_added = 0;
            $contract->has_agreement = 0;
            $contract->save();
        } else {
            $unit = AgreementUnit::where('agreement_id', $agreementid)->first();
            $contract_unit_id = $unit->contract_unit_details_id;
            $subunit_id = $unit->contract_subunit_details_id;
            $subunit = ContractSubunitDetail::find($subunit_id);
            if ($subunit) {
                $subunit->is_vacant = 0;
                $subunit->save();
            }
            $hasSubunits = ContractSubunitDetail::where('contract_unit_detail_id', $contract_unit_id)->exists();

            if (
                !$hasSubunits || ContractSubunitDetail::where('contract_unit_detail_id', $contract_unit_id)
                ->where('is_vacant', 1)
                ->doesntExist()
            ) {
                $unit = ContractUnitDetail::find($contract_unit_id);
                if ($unit) {
                    $unit->is_vacant = 0;
                    $unit->save();
                }
            }

            $allUnitsVacant = $contract->contract_unit_details()->where('is_vacant', 1)->doesntExist();
            if ($allUnitsVacant) {
                $contract->is_vacant = 0;
                $contract->has_agreement = 0;
                $contract->save();
            }
        }
    }
}
