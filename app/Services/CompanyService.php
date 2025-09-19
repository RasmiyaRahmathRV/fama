<?php

namespace App\Services;

use App\Models\Area;
use App\Repositories\CompanyRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CompanyService
{
    protected $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function getAll()
    {
        return $this->companyRepository->all();
    }

    public function getById($id)
    {
        return $this->companyRepository->find($id);
    }

    public function getIdByCompanyname(string $companyName): ?string
    {
        return $this->companyRepository->findId(['company_name' => $companyName])?->id;
    }

    public function create(array $data, $user_id = null)
    {
        $this->validate($data);
        $data['added_by'] = $user_id ? $user_id : auth()->user()->id;
        $data['company_code'] = $this->setCompanyCode();
        return $this->companyRepository->create($data);
    }

    public function update($id, array $data)
    {
        $this->validate($data);
        $data['updated_by'] = auth()->user()->id;
        return $this->companyRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->companyRepository->delete($id);
    }

    public function setCompanyCode()
    {
        $codeService = new \App\Services\CodeGeneratorService();
        return $codeService->generateNextCode('companies', 'company_code', 'CMP', 5);
    }

    private function validate(array $data)
    {
        $validator = Validator::make($data, [
            'company_name' => 'required|unique:companies,company_name',
            // ], [
            //     'company_name.unique' => 'This company name already exists. Please choose another.',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
