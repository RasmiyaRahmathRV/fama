<?php

namespace App\Repositories\Investment;

use App\Models\InvestmentReferral;
use Illuminate\Contracts\Database\Eloquent\Builder;

class InvestmentReferralRepository
{
    public function all()
    {
        return InvestmentReferral::all();
    }

    public function find($id)
    {
        return InvestmentReferral::findOrFail($id);
    }



    public function create($data)
    {
        return InvestmentReferral::create($data);
    }
}
