<?php

namespace App\Repositories\Contracts;

use App\Models\ContractDetail;

class ContractDetailRepository
{
    public function all()
    {
        return ContractDetail::all();
    }

    public function find($id)
    {
        return ContractDetail::findOrFail($id);
    }

    public function getByName($contractDetail)
    {
        return ContractDetail::where($contractDetail)->first();
    }

    public function create($data)
    {
        return ContractDetail::create($data);
    }

    public function delete($id)
    {
        $area = $this->find($id);
        return $area->delete();
    }
}
