<?php

namespace App\Repositories;

use App\Models\Contract;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ContractRepository
{
    public function all()
    {
        return Contract::all();
    }

    public function find($id)
    {
        return Contract::findOrFail($id);
    }

    public function findId($data)
    {
        return Contract::where($data)->first();
    }

    public function create(array $data)
    {
        return Contract::create($data);
    }

    public function update($id, array $data)
    {
        $contract = $this->find($id);
        $contract->update($data);
        return $contract;
    }
    public function delete($id)
    {
        $contract = $this->find($id);
        $contract->deleted_by = auth()->user()->id;
        $contract->save();
        return $contract->delete();
    }

    public function checkIfExist($data)
    {
        $existing = Contract::withTrashed()
            ->where('contract_name', $data['contract_name'])
            ->first();

        if ($existing && $existing->trashed()) {
            // $existing->restore();
            return $existing;
        }
    }

    public function getQuery(array $filters = []): Builder
    {
        $query = Contract::query()
            ->select('contracts.*', 'industries.name as industry_name')
            ->join('vendors', 'vendors.id', '=', 'contracts.vendor_id');

        if (!empty($filters['search'])) {
            $query->orwhere('company_name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('company_code', 'like', '%' . $filters['search'] . '%')
                ->orWhere('phone', 'like', '%' . $filters['search'] . '%')
                ->orWhere('email', 'like', '%' . $filters['search'] . '%')
                ->orWhere('address', 'like', '%' . $filters['search'] . '%')
                ->orWhere('website', 'like', '%' . $filters['search'] . '%')

                ->orWhereHas('industry', function ($q) use ($filters) {
                    $q->where('name', 'like', '%' . $filters['search'] . '%');
                })
                ->orWhereRaw("CAST(companies.id AS CHAR) LIKE ?", ['%' . $filters['search'] . '%']);
        }

        if (!empty($filters['company_id'])) {
            $query->Where('companies.id', $filters['company_id']);
        }

        return $query;
    }
}
