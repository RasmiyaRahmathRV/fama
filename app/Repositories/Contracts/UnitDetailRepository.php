<?php

namespace App\Repositories\Contracts;

use App\Models\ContractUnitDetail;

class UnitDetailRepository
{
    public function all()
    {
        return ContractUnitDetail::all();
    }

    public function find($id)
    {
        return ContractUnitDetail::findOrFail($id);
    }

    public function getByName($contractUnitDet)
    {
        return ContractUnitDetail::where($contractUnitDet)->first();
    }

    public function create($data)
    {
        return ContractUnitDetail::create($data);
    }

    public function createMany(array $dataArray)
    {
        $detId = [];
        foreach ($dataArray as $data) {
            $detId[] = ContractUnitDetail::create($data);
        }
        return  $detId;
    }


    public function delete($id)
    {
        $area = $this->find($id);
        return $area->delete();
    }
}
