<?php

namespace App\Repositories\Agreement;

use App\Models\Agreement;
use App\Models\AgreementDocument;
use App\Models\AgreementPayment;
use App\Models\Contract;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class AgreementPaymentRepository
{


    public function create(array $data)
    {
        return AgreementPayment::create($data);
    }
    public function update($id, array $data)
    {
        $payment = $this->find($id);
        $payment->update($data);
        return $payment;
    }
    public function find($id)
    {
        return AgreementPayment::findOrFail($id);
    }
}
