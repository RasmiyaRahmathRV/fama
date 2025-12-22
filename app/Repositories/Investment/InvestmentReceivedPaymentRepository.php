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
}
