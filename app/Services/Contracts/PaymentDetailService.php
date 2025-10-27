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
        $requireIfPaymentMode = function ($attribute, $value, $fail) use ($data) {
            if (in_array($data['payment_mode_id'], [2, 3]) && empty($value)) {
                $field = str_replace('payment_detail.*.', '', $attribute); // clean field name
                $fail("The {$field} is required because payment mode is not full building.");
            }
        };

        $validator = Validator::make(['payment_detail' => $data], [
            'payment_detail' => 'required|array|min:1',
            'payment_detail.*.payment_mode_id' => 'required',
            'payment_detail.*.payment_date' => 'required',
            'payment_detail.*.payment_amount' => 'required',
            'payment_detail.*.bank_id' => ['nullable', $requireIfPaymentMode],
            'payment_detail.*.cheque_no' => ['nullable', $requireIfPaymentMode],
        ]);


        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
