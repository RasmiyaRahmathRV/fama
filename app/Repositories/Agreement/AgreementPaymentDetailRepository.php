<?php

namespace App\Repositories\Agreement;

use App\Models\Agreement;
use App\Models\AgreementDocument;
use App\Models\AgreementPaymentDetail;
use App\Models\Contract;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class AgreementPaymentDetailRepository
{


    public function create(array $data)
    {
        return AgreementPaymentDetail::create($data);
    }
    public function update($id, array $data)
    {
        $detail = $this->find($id);
        $detail->update($data);
        return $detail;
    }
    public function find($id)
    {
        return AgreementPaymentDetail::findOrFail($id);
    }
    public function deleteWhereIn($column, array $values)
    {
        return AgreementPaymentDetail::whereIn($column, $values)->delete();
    }

    public function getWhere(array $conditions)
    {
        return AgreementPaymentDetail::where($conditions)->get();
    }
}
