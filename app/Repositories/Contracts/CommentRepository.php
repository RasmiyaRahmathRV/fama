<?php

namespace App\Repositories\Contracts;

use App\Models\ContractApprovalComment;

class CommentRepository
{
    public function all()
    {
        return ContractApprovalComment::all();
    }

    public function find($id)
    {
        return ContractApprovalComment::findOrFail($id);
    }

    public function getByContractId($contract_id)
    {
        return ContractApprovalComment::with('user')->where('contract_id', $contract_id)->get();
    }

    public function create($data)
    {
        return ContractApprovalComment::create($data);
    }

    public function update($id, array $data)
    {
        $contractComm = $this->find($id);
        $contractComm->update($data);
        return $contractComm;
    }

    public function delete($id)
    {
        $area = $this->find($id);
        return $area->delete();
    }
}
