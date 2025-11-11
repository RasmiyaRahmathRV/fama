<?php

namespace App\Repositories\Agreement;

use App\Models\Agreement;
use App\Models\AgreementDocument;
use App\Models\AgreementTenant;
use App\Models\Contract;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class AgreementTenantRepository
{


    public function create(array $data)
    {
        return AgreementTenant::create($data);
    }
    public function update($id, array $data)
    {
        $tenant = $this->find($id);
        // dd($tenant);
        $tenant->update($data);
        return $tenant;
    }
    public function find($id)
    {
        // dd($id);
        return AgreementTenant::findOrFail($id);
    }
}
