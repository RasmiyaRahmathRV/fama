<?php

namespace App\Repositories\Contracts;

use App\Models\ContractSubunitDetail;

class SubUnitDetailRepository
{
    public function all()
    {
        return ContractSubunitDetail::all();
    }

    public function find($id)
    {
        return ContractSubunitDetail::findOrFail($id);
    }

    public function getByName($contractSubun)
    {
        return ContractSubunitDetail::where($contractSubun)->first();
    }

    public function create($data)
    {
        return ContractSubunitDetail::create($data);
    }

    public function delete($id)
    {
        $area = $this->find($id);
        return $area->delete();
    }
}
