<?php

namespace App\Repositories\Contracts;

use App\Models\ContractDocument;

class DocumentRepository
{
    public function all()
    {
        return ContractDocument::all();
    }

    public function find($id)
    {
        return ContractDocument::findOrFail($id);
    }

    public function getByName($contractDetail)
    {
        return ContractDocument::where($contractDetail)->first();
    }

    public function create($data)
    {
        return ContractDocument::create($data);
    }

    public function delete($id)
    {
        $area = $this->find($id);
        return $area->delete();
    }
}
