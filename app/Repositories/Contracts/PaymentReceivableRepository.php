<?php

namespace App\Repositories\Contracts;

use App\Models\ContractPaymentReceivable;

class PaymentReceivableRepository
{
    public function all()
    {
        return ContractPaymentReceivable::all();
    }

    public function find($id)
    {
        return ContractPaymentReceivable::findOrFail($id);
    }

    public function getByName($contractPaymentDet)
    {
        return ContractPaymentReceivable::where($contractPaymentDet)->first();
    }

    public function create($data)
    {
        return ContractPaymentReceivable::create($data);
    }

    public function createMany(array $dataArray)
    {
        $detId = [];
        foreach ($dataArray as $data) {
            $detId[] = ContractPaymentReceivable::create($data);
        }
        return  $detId;
    }

    public function updateMany(array $data)
    {
        $detId = [];
        foreach ($data as $key => $value) {
            $paymentdet = $this->find($key);
            $paymentdet->update($value);

            $detId[] = $key;
        }
        return  $detId;
    }

    public function delete($id)
    {
        $area = $this->find($id);
        return $area->delete();
    }
}
