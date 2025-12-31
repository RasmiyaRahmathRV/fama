<?php

namespace App\Repositories\Investment;

use App\Models\InvestmentReceivedPayment;
use Illuminate\Contracts\Database\Eloquent\Builder;

class InvestmentReceivedPaymentRepository
{
    public function all()
    {
        return InvestmentReceivedPayment::all();
    }

    public function find($id)
    {
        return InvestmentReceivedPayment::findOrFail($id);
    }

    public function create($data)
    {
        return InvestmentReceivedPayment::create($data);
    }
    public function updateInitial($id, $data)
    {
        $payment = InvestmentReceivedPayment::where('investment_id', $id)
            ->where('is_initial_payment', 1)
            ->first();
        if ($payment) {

            $payment->update($data);
            return $payment;
        }
    }
    public function update($id, $data)
    {
        $payment = InvestmentReceivedPayment::findOrFail($id);
        $payment->update($data);

        return $payment;
    }
}
