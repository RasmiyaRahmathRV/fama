<?php

namespace App\Repositories\Agreement;

use App\Models\Agreement;
use App\Models\AgreementDocument;
use App\Models\AgreementTenant;
use App\Models\AgreementUnit;
use App\Models\Contract;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class AgreementUnitRepository
{


    public function create(array $data)
    {
        // dd($data);
        return AgreementUnit::create($data);
    }
    public function update($id, array $data)
    {
        $unit = $this->find($id);
        $unit->update($data);
        return $unit;
    }
    public function find($id)
    {
        return AgreementUnit::findOrFail($id);
    }
}
