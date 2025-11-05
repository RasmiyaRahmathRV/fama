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

class AgreementPaymentDetailService
{
    public function __construct(
        protected AgreementRepository $agreementRepository,
        protected AgreementDocRepository $agreementDocRepository,
        protected AgreementTenantRepository $agreementTenantRepository,
        protected AgreementPaymentRepository $agreementPaymentRepository,
        protected AgreementPaymentDetailRepository $agreementPaymentDetailRepository,
        protected AgreementUnitRepository $agreementUnitRepository,
        protected AgreementTenantService $agreementTenantService,

    ) {}
    public function create($data)
    {
        $this->validate($data);
        $this->agreementPaymentDetailRepository->create($data);
    }
    private function validate(array $data, $id = null)
    {
        $validator = Validator::make($data, [
            'payment_mode_id' => 'required',
            'payment_date' => 'required',
            'payment_amount' => 'required',
            // Bank & Cheque conditional rules
            'bank_id' => [
                'nullable',
                'integer',
                Rule::requiredIf(function () use ($data) {
                    return isset($data['payment_mode_id']) && in_array($data['payment_mode_id'], [2, 3]);
                }),
            ],
            'cheque_number' => [
                'nullable',
                'string',
                Rule::requiredIf(function () use ($data) {
                    return isset($data['payment_mode_id']) && $data['payment_mode_id'] == 3;
                }),
            ]
        ], [
            'payment_mode_id.required' => 'Payment mode is required.',
            'payment_date.required'    => 'Payment date is required.',
            'payment_amount.required'  => 'Payment amount is required.',
            'payment_amount.numeric'   => 'Payment amount is required',
            'bank_id.required'         => 'Bank name is required ',
            'cheque_number.required'   => 'Cheque number is required for cheque payments.',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
