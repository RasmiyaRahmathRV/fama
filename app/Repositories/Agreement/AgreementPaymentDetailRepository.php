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
}
