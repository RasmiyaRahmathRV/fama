<?php

namespace App\Services\Investment;

use App\Repositories\Investment\InvestmentDocumentRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class InvestmentDocumentService
{
    public function __construct(
        protected InvestmentDocumentRepository $investmentDocumentRepository,
    ) {}


    public function getAll()
    {
        return $this->investmentDocumentRepository->all();
    }

    public function getById($id)
    {
        return $this->investmentDocumentRepository->find($id);
    }

    // public function getByName($name)
    // {
    //     return $this->investmentDocumentRepository->getByName($name);
    // }

    public function create(array $data, $user_id = null)
    {
        // dd($data);
        // $this->validate($data);
        $record = $this->investmentDocumentRepository->create($data);
        return $record;
    }

    public function update($id, array $data)
    {
        // $this->validate($data, $id);
        // $data['updated_by'] = auth()->user()->id;
        // return $this->investmentDocumentRepository->update($id, $data);
    }

    // public function delete($id)
    // {
    //     return $this->investmentDocumentRepository->delete($id);
    // }


    private function validate(array $data, $id = null)
    {
        $validator = Validator::make($data, [

            'investment_contract_file_name' => 'required|string|max:255',
            'investment_contract_file_path' => 'required|string|max:500',
        ], [

            'investment_contract_file_name.required' => 'Contract file name is required.',
            'investment_contract_file_name.string' => 'Contract file name must be a string.',
            'investment_contract_file_name.max' => 'Contract file name cannot exceed 255 characters.',
            'investment_contract_file_path.required' => 'Contract file path is required.',
            'investment_contract_file_path.string' => 'Contract file path must be a string.',
            'investment_contract_file_path.max' => 'Contract file path cannot exceed 500 characters.',

        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
