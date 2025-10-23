<?php

namespace App\Services;

use App\Models\Contract;
use App\Repositories\Contracts\AgreementRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AgreementService
{
    protected $agreementRepository;

    public function __construct(AgreementRepository $agreementRepository)
    {
        $this->agreementRepository = $agreementRepository;
    }


    public function getAll()
    {
        return $this->agreementRepository->all();
    }

    public function getById($id)
    {
        return $this->agreementRepository->find($id);
    }

    public function createOrRestore(array $data, $user_id = null)
    {
        $this->validate($data);
        $data['added_by'] = $user_id ? $user_id : auth()->user()->id;
        $data['project_code'] = $this->setProjectCode();


        // $existing = $this->agreementRepository->checkIfExist($data);

        // if ($existing) {
        //     if ($existing->trashed()) {
        //         $existing->restore();
        //     }
        //     $existing->fill($data);
        //     $existing->save();
        //     return $existing;
        // }

        return $this->agreementRepository->create($data);
    }
    public function setProjectCode($addval = 1)
    {
        $codeService = new \App\Services\CodeGeneratorService();
        return $codeService->generateNextCode('contracts', 'project_code', 'PRJ', 5, $addval);
    }

    public function update($id, array $data)
    {
        $this->validate($data, $id);
        $data['updated_by'] = auth()->user()->id;
        return $this->agreementRepository->update($id, $data);
    }

    private function validate(array $data, $id = null)
    {
        $validator = Validator::make($data, [], []);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

}
