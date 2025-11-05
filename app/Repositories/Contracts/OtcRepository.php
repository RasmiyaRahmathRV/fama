<?php

namespace App\Repositories\Contracts;

use App\Models\ContractOtc;

class OtcRepository
{
    public function all()
    {
        return ContractOtc::all();
    }

    public function find($id)
    {
        return ContractOtc::findOrFail($id);
    }

    public function getByName($contractOtc)
    {
        return ContractOtc::where($contractOtc)->first();
    }

    public function create($data)
    {
        return ContractOtc::create($data);
    }

    public function update($id, array $data)
    {
        $contractOtc = $this->find($id);
        $contractOtc->update($data);
        return $contractOtc;
    }

    public function delete($id)
    {
        $area = $this->find($id);
        return $area->delete();
    }
}
