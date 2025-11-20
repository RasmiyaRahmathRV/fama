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

class AgreementTenantService
{
    public function __construct(
        protected AgreementRepository $agreementRepository,
        protected AgreementDocRepository $agreementDocRepository,
        protected AgreementTenantRepository $agreementTenantRepository,


    ) {}
    public function create($data)
    {
        $this->validate($data);
        $this->agreementTenantRepository->create($data);
    }
    private function validate(array $data, $id = null)
    {
        $validator = Validator::make($data, [
            'tenant_name' => 'required',
            'tenant_mobile' => ['required', 'regex:/^\+?\d{1,4}\s?\d{7,12}$/'],
            'tenant_email' => 'required|email:rfc,dns',
            'nationality_id' =>  'required',
            'tenant_address' =>  'required',
            'contact_person' => 'required',
            'contact_number' => ['required', 'regex:/^\+?\d{1,4}\s?\d{7,12}$/'],
            'contact_email' => 'required|email:rfc,dns',
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
        return $this->agreementTenantRepository->update($id, $data);
    }
}
