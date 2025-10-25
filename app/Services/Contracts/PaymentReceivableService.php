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
        foreach ($dataArr['payment_date'] as $key => $value) {

            $data[] = array(
                'contract_id' => $contract_id,
                'added_by' => $user_id ? $user_id : auth()->user()->id,
                'receivable_date' => $value,
                'receivable_amount' => $dataArr['payment_amount'][$key],
            );

            $this->validate($data);
        }

        return $this->paymentreceRepo->createMany($data);
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
