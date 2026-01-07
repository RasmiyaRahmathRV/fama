<?php

namespace App\Services\Contracts;

use App\Repositories\Contracts\PaymentRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PaymentService
{
    public function __construct(
        protected PaymentRepository $paymentRepo,
        protected PaymentDetailService $paymentdetServ,
        protected PaymentReceivableService $paymentrecServ,
    ) {}

    public function getAll()
    {
        return $this->paymentRepo->all();
    }

    public function getById($id)
    {
        return $this->paymentRepo->find($id);
    }

    public function create($contract_id, array $data, array $detail, array $receivables, $user_id = null)
    {
        $this->validate($data);
        $data['contract_id'] = $contract_id;
        $data['added_by'] = $user_id ? $user_id : auth()->user()->id;

        return DB::transaction(function () use ($contract_id, $data, $detail, $receivables) {
            $payment = $this->paymentRepo->create($data);

            $this->paymentdetServ->create($contract_id, $detail, $payment->id);
            $this->paymentrecServ->create($contract_id, $receivables);

            return $payment;
        });

        return;
    }

    public function update($contract_id, array $data, array $detail, array $receivables, $user_id = null)
    {
        $id = $data['id'];
        $this->validate($data, $id);
        $data['updated_by'] = $user_id ? $user_id : auth()->user()->id;
        // return 

        return DB::transaction(function () use ($id, $data, $detail, $receivables, $contract_id) {
            $payment = $this->paymentRepo->update($id, $data);

            $this->paymentdetServ->update($contract_id, $detail, $payment->id);

            $this->paymentrecServ->update($contract_id, $receivables);

            return $payment;
        });

        return;
    }

    private function validate(array $data, $id = null)
    {
        $validator = Validator::make($data, [
            'installment_id' => 'required',
            'interval' => 'required'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
