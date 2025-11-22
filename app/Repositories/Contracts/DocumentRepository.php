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

    public function findByDocumentType($contract_id, $document_type)
    {
        return ContractDocument::where([
            ['contract_id', '=', $contract_id],
            ['document_type_id', '=', $document_type],
        ])->first();
    }

    public function findByContractId($contract_id)
    {
        return ContractDocument::where('contract_id', '=', $contract_id)->get();
    }

    public function getByName($contractDetail)
    {
        return ContractDocument::where($contractDetail)->first();
    }

    public function create($data)
    {
        return ContractDocument::create($data);
    }

    public function update($id, array $data)
    {
        $document = $this->find($id);

        $document->update($data);
        return $document;
    }

    public function delete($id)
    {
        $area = $this->find($id);
        return $area->delete();
    }
}
