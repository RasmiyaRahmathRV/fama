<?php

namespace App\Repositories\Contracts;

use App\Models\Contract;
use App\Models\ContractScope;
use App\Models\ContractUnitDetail;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ContractScopeRepository
{
    public function find($id)
    {
        return ContractScope::findOrFail($id);
    }

    public function findBYContractId($contractId)
    {
        return ContractScope::where('contract_id', $contractId)->first();
    }

    public function create(array $data)
    {
        // dd($data);
        $data['generated_by'] = auth()->user()->id;
        return ContractScope::create($data);
    }

    public function update(array $data, $id)
    {
        $scope = $this->find($id);
        $data['updated_by'] = auth()->user()->id;
        $scope->update($data);
        return $scope;
    }
}
