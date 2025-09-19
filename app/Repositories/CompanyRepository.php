<?php

namespace App\Repositories;

use App\Models\Company;
use Illuminate\Support\Facades\DB;

class CompanyRepository
{
    public function all()
    {
        return Company::all();
    }

    public function find($id)
    {
        return Company::findOrFail($id);
    }

    public function findId($data)
    {
        return Company::where($data)->first();
    }

    public function create(array $data)
    {
        return Company::create($data);
    }

    public function update($id, array $data)
    {
        $company = $this->find($id);
        $company->update($data);
        return $company;
    }

    public function delete($id)
    {
        $company = $this->find($id);
        return $company->delete();
    }
}
