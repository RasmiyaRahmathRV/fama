<?php

namespace App\Repositories\Contracts;

use App\Models\ContractPaymentDetail;

class PaymentDetailRepository
{
    public function all()
    {
        return ContractPaymentDetail::all();
    }

    public function find($id)
    {
        return ContractPaymentDetail::findOrFail($id);
    }

    public function getByName($contractPaymentDet)
    {
        return ContractPaymentDetail::where($contractPaymentDet)->first();
    }

    public function create($data)
    {
        return ContractPaymentDetail::create($data);
    }

    public function createMany(array $dataArray)
    {
        $detId = [];
        foreach ($dataArray as $data) {
            $detId[] = ContractPaymentDetail::create($data);
        }
        return  $detId;
    }

    public function delete($id)
    {
        $area = $this->find($id);
        return $area->delete();
    }
}
