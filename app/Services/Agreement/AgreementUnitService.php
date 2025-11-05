<?php

namespace App\Services\Agreement;

use App\Models\Contract;
use App\Repositories\Agreement\AgreementDocRepository;
use App\Repositories\Agreement\AgreementPaymentDetailRepository;
use App\Repositories\Agreement\AgreementPaymentRepository;
use App\Repositories\Agreement\AgreementRepository;
use App\Repositories\Agreement\AgreementTenantRepository;
use App\Repositories\Agreement\AgreementUnitRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AgreementUnitService
{
    public function __construct(
        protected AgreementRepository $agreementRepository,
        protected AgreementDocRepository $agreementDocRepository,
        protected AgreementUnitRepository $agreementUnitRepository,


    ) {}
    public function create($data)
    {
        $this->validate($data);
        return  $this->agreementUnitRepository->create($data);
    }
    private function validate(array $data, $id = null)
    {
        $validator = Validator::make($data, [
            'unit_type_id' => 'required',
            'contract_unit_details_id' => 'required',
            // 'contract_subunit_details_id' => $'required',
            'rent_per_month' => 'required',
        ], [
            'unit_type_id.required' => 'Unit type is required.',
            'contract_unit_details_id.required' => 'Unit Number is required.',
            'rent_per_month.required' => 'Rent per month is required.',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
