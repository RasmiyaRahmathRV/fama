<?php

namespace App\Services\Contracts;

use App\Repositories\Contracts\PaymentReceivableRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PaymentReceivableService
{
    public function __construct(
        protected PaymentReceivableRepository $paymentreceRepo,
    ) {}

    public function getAll()
    {
        return $this->paymentreceRepo->all();
    }

    public function getById($id)
    {
        return $this->paymentreceRepo->find($id);
    }

    public function create($contract_id, array $dataArr, $user_id = null)
    {

        $data = [];
        foreach ($dataArr['receivable_date'] as $key => $value) {

            $data[] = array(
                'contract_id' => $contract_id,
                'added_by' => $user_id ? $user_id : auth()->user()->id,
                'receivable_date' => $value,
                'receivable_amount' => toNumeric($dataArr['payment_amount'][$key]),
            );

            $this->validate($data);
        }

        return $this->paymentreceRepo->createMany($data);
    }

    public function update($contract_id, array $dataArr, $user_id = null)
    {
        $data = [];
        $insertArr = [];
        foreach ($dataArr['receivable_date'] as $key => $value) {
            $dataArray = [];

            $dataArray[] = array(
                'contract_id' => $contract_id,
                'updated_by' => $user_id ? $user_id : auth()->user()->id,
                'receivable_date' => $value,
                'receivable_amount' => toNumeric($dataArr['payment_amount'][$key]),
            );

            if (isset($dataArr['id'][$key])) {
                $id = $dataArr['id'][$key];
                $data[$id] = $dataArray[0];
            } else {
                $dataArray[0]['added_by'] = $user_id ? $user_id : auth()->user()->id;

                $insertArr[] = $dataArray[0];
            }

            $this->validate($data);
        }
        // dd($insertArr);
        $paymentDetId = $this->paymentreceRepo->updateMany($data);

        if ($insertArr) {

            $detailids = $this->paymentreceRepo->createMany($insertArr);
            $paymentDetId = array_merge($paymentDetId, $detailids);
        }

        return $paymentDetId;
    }

    public function calculateNewDate($date, $i)
    {
        $i = 1;

        // Parse the custom format
        $startDate = Carbon::createFromFormat('d-m-Y', $date);

        // Add days
        $newDate = $startDate->copy()->addMonths($i);

        // Format back to dd-mm-yyyy
        echo $newDate->format('Y-m-d'); // output: 24-10-2025
    }

    private function validate(array $data, $id = null)
    {
        $validator = Validator::make(['detail' => $data], [
            'detail' => 'required|array|min:1',
            'detail.*.receivable_date' => 'required',
            'detail.*.receivable_amount' => 'required',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
