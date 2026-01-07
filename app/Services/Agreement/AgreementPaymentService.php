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

class AgreementPaymentService
{
    public function __construct(
        protected AgreementRepository $agreementRepository,
        protected AgreementPaymentRepository $agreementPaymentRepository,
        protected AgreementTenantRepository $agreementTenantRepository,


    ) {}
    public function create($data)
    {
        $this->validate($data);
        return  $this->agreementPaymentRepository->create($data);
    }
    private function validate(array $data, $id = null)
    {
        $validator = Validator::make($data, [
            'installment_id' => 'required',
            'interval' => 'required',
            'beneficiary' => 'required',
        ], []);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
    public function update(array $data, $user_id = null)
    {
        // dd($data);
        $id = $data['id'];
        $this->validate($data, $id);
        $data['updated_by'] = $user_id ? $user_id : auth()->user()->id;
        return $this->agreementPaymentRepository->update($id, $data);
    }
}
