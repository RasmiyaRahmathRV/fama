<?php

namespace App\Repositories\Contracts;

use App\Models\ContractRental;

class RentalRepository
{
    public function all()
    {
        return ContractRental::all();
    }

    public function find($id)
    {
        return ContractRental::findOrFail($id);
    }

    public function getByName($contractRent)
    {
        return ContractRental::where($contractRent)->first();
    }

    public function create($data)
    {
        return ContractRental::create($data);
    }

    public function update($id, array $data)
    {
        $contractRent = $this->find($id);
        $contractRent->update($data);
        return $contractRent;
    }

    public function delete($id)
    {
        $area = $this->find($id);
        return $area->delete();
    }
}
