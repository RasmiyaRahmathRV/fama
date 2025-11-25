<?php

namespace App\Services\Contracts;

use App\Repositories\Contracts\CommentRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ContractCommentService
{
    public function __construct(
        protected CommentRepository $commentRepo,
    ) {}

    public function getAll()
    {
        return $this->commentRepo->all();
    }

    public function getById($id)
    {
        return $this->commentRepo->find($id);
    }

    public function getByContractId($contract_id)
    {
        return $this->commentRepo->getByContractId($contract_id);
    }

    public function create($contract_id, array $data, $user_id = null)
    {
        $this->validate($data);
        $data['contract_id'] = $contract_id;
        $data['user_id'] = $user_id ? $user_id : auth()->user()->id;

        return $this->commentRepo->create($data);
    }



    private function validate(array $data, $id = null) {}
}
