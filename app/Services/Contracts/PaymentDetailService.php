<?php

namespace App\Services\Contracts;

use App\Repositories\Contracts\PaymentDetailRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PaymentDetailService
{
    public function __construct(
        protected PaymentDetailRepository $paymentdetRepo,
    ) {}

    public function getAll()
    {
        return $this->paymentdetRepo->all();
    }

    public function getById($id)
    {
        return $this->paymentdetRepo->find($id);
    }

    public function create($contract_id, array $dataArr, $payment_id, $user_id = null)
    {
        $data = [];
        foreach ($dataArr['payment_mode_id'] as $key => $value) {

            $data[] = array(
                'contract_id' => $contract_id,
                'contract_payment_id' => $payment_id,
                'added_by' => $user_id ? $user_id : auth()->user()->id,
                'payment_mode_id' => $value,
                'payment_date' => $dataArr['payment_date'][$key],
                'payment_amount' => $dataArr['payment_amount'][$key],
                'bank_id' => $dataArr['bank_id'][$key],
                'cheque_no' => $dataArr['cheque_no'][$key],
                // 'cheque_issuer' => $dataArr['cheque_issuer'][$key],
                // 'cheque_issuer_name' => $dataArr['cheque_issuer_name'][$key],
                // 'cheque_issuer_id' => $dataArr['cheque_issuer_id'][$key]
            );

            $this->validate($data);
        }


        return $this->paymentdetRepo->createMany($data);
    }

    private function validate(array $data, $id = null)
    {
        $validator = Validator::make($data, [
            // 'cheque_no' => [
            //     'required',
            //     Rule::unique('contract_payment_details')->ignore($id)
            //         ->where(fn($q) => $q
            //             // ->where('company_id', $data['company_id'])
            //             ->whereNull('deleted_at'))
            // ],
            // 'nationality_short_code' => 'required',
            // 'company_id' => 'required|exists:companies,id',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
