<?php

namespace App\Repositories\Contracts;

use App\Models\ContractPayment;

class PaymentRepository
{
    public function all()
    {
        return ContractPayment::all();
    }

    public function find($id)
    {
        return ContractPayment::findOrFail($id);
    }

    public function getByName($contractPayment)
    {
        return ContractPayment::where($contractPayment)->first();
    }

    public function create($data)
    {
        return ContractPayment::create($data);
    }

    public function delete($id)
    {
        $area = $this->find($id);
        return $area->delete();
    }
}
