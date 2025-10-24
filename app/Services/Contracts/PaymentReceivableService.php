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
        $startDate = Carbon::createFromFormat('d-m-Y', $dataArr['vc_start_date']);
        $endDate = Carbon::createFromFormat('d-m-Y', $dataArr['vc_end_date']);
        $monthlyAmount = $dataArr['rent_receivable_per_month'];

        $totalDays = $startDate->diffInDays($endDate); // inclusive
        $totalMonths = (int)ceil($totalDays / 30); // rough approximation

        print_r($totalMonths);
        // if ($startDate->day != 1) {
        //     $totalMonths += 1;
        // }

        for ($i = 0; $i < $totalMonths; $i++) {

            if ($i === 0 && $startDate->day != 1) {
                $periodStart = $startDate->copy();
                $periodEnd = $startDate->copy()->endOfMonth();
                $daysInMonth = $periodEnd->day;
                $remainingDays = $daysInMonth - $startDate->day;
                $amount = round(($monthlyAmount / 30) * $remainingDays, 2);
            } elseif ($i === $totalMonths - 1 && $endDate->day != $endDate->copy()->endOfMonth()->day) {
                $periodStart = $startDate->copy()->addMonths($i)->startOfMonth();
                $periodEnd = $endDate->copy();
                $daysInMonth = $periodEnd->copy()->endOfMonth()->day;
                $amount = round(($monthlyAmount / 30) * $periodEnd->day, 2);
            } else {
                $periodStart = $startDate->copy()->addMonths($i)->startOfMonth();
                $periodEnd = $periodStart->copy()->endOfMonth();
                $amount = $monthlyAmount;
            }


            $data[] = array(
                'contract_id' => $contract_id,
                'added_by' => $user_id ? $user_id : auth()->user()->id,
                'receivable_date' => $periodStart->format('Y-m-d'),
                'receivable_amount' => $amount,
            );

            $this->validate($data);
        }
        dd($data);
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
