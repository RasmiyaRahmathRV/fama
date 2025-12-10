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

    public function create(array $data)
    {
        if ($data['contract_status'] != 4) {
            $this->validate($data);
        }

        if ($data['contract_status']) {
            // dump($data);
            contractStatusUpdate($data['contract_status'], $data['contract_id']);
        }

        return $this->commentRepo->create($data);
    }

    private function validate(array $data, $id = null)
    {
        $validator = Validator::make($data, [
            'comment' => 'required',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
