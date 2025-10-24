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

    public function create($contract_id, array $data, array $detail, $durationInMonth, $user_id = null)
    {
        $this->validate($data);
        $data['contract_id'] = $contract_id;
        $data['added_by'] = $user_id ? $user_id : auth()->user()->id;

        return DB::transaction(function () use ($contract_id, $data, $detail, $durationInMonth) {
            $payment = $this->paymentRepo->create($data);

            $this->paymentdetServ->create($contract_id, $detail, $payment->id);
            $this->paymentrecServ->create($contract_id, $durationInMonth, $payment->id);

            return $payment;
        });

        return;
    }

    private function validate(array $data, $id = null)
    {
        $validator = Validator::make($data, [
            // 'nationality_name' => [
            //     'required',
            //     Rule::unique('nationalities')->ignore($id)
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
