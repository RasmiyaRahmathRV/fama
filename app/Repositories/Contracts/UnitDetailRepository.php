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

    public function update($id, array $data)
    {
        $contractUnitDet = $this->find($id);
        $contractUnitDet->update($data);
        return $contractUnitDet;
    }

    public function createMany(array $dataArray)
    {
        $detId = [];
        foreach ($dataArray as $data) {
            $detId[] = ContractUnitDetail::create($data)->id;
        }
        return  $detId;
    }

    public function updateMany(array $dataArray)
    {
        $detId = [];
        foreach ($dataArray as $id => $data) {
            ContractUnitDetail::where('id', $id)->update($data);
            $detId[] = $id;
        }
        return  $detId;
    }

    public function delete($id)
    {
        $area = $this->find($id);
        return $area->delete();
    }
}
