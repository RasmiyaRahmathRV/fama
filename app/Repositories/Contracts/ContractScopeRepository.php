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

    public function create(array $data)
    {
        // dd($data);
        $data['generated_by'] = auth()->user()->id;
        return ContractScope::create($data);
    }
}
