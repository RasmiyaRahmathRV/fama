<?php

namespace App\Services\Investment;

use App\Repositories\Investment\InvestmentDocumentRepository;
use Illuminate\Support\Facades\Storage;
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
        $data['added_by'] = auth()->user()->id;
        $record = $this->investmentDocumentRepository->create($data);
        return $record;
    }

    public function update($id, array $data)
    {
        // dd($data);
        $this->validate($data);
        $data['updated_by'] = auth()->user()->id;
        $existingDoc = $this->investmentDocumentRepository->find($id);
        if ($existingDoc && $existingDoc->investment_contract_file_path) {
            if (Storage::disk('public')->exists($existingDoc->investment_contract_file_path)) {
                Storage::disk('public')->delete($existingDoc->investment_contract_file_path);
            }

            $this->investmentDocumentRepository->update($id, $data);
        }
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
