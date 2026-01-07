<?php

namespace App\Repositories\Contracts;

use App\Models\ContractUnit;

class UnitRepository
{
    public function all()
    {
        return ContractUnit::all();
    }

    public function find($id)
    {
        return ContractUnit::findOrFail($id);
    }

    public function getByName($contractUnit)
    {
        return ContractUnit::where($contractUnit)->first();
    }

    public function create($data)
    {
        return ContractUnit::create($data);
    }

    public function update($id, array $data)
    {
        $contractUnit = $this->find($id);
        $contractUnit->update($data);
        return $contractUnit;
    }

    public function delete($id)
    {
        $area = $this->find($id);
        return $area->delete();
    }
}
