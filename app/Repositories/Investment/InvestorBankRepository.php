<?php

namespace App\Repositories\Investment;

use App\Models\InvestorBank;
use Illuminate\Contracts\Database\Eloquent\Builder;

class InvestorBankRepository
{
    public function all()
    {
        return InvestorBank::all();
    }
    public function allActive()
    {
        return InvestorBank::where('status', 1)->get();
    }


    public function find($id)
    {
        return InvestorBank::findOrFail($id);
    }

    public function getByName($investorData)
    {
        return InvestorBank::where($investorData)->first();
    }

    public function create($data)
    {
        return InvestorBank::create($data);
    }

    public function updateOrRestore(int $id, array $data)
    {
        $investor = InvestorBank::withTrashed()->findOrFail($id);
        $investor->update($data);

        return $investor;
    }

    public function delete($id)
    {
        $investor = $this->find($id);
        return $investor->delete();
    }
}
