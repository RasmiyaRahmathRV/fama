<?php

namespace App\Repositories\Agreement;

use App\Models\Agreement;
use App\Models\AgreementDocument;
use App\Models\Contract;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class AgreementDocRepository
{



    public function create(array $data)
    {
        return AgreementDocument::create($data);
    }
    public function update(array $data)
    {
        return AgreementDocument::update($data);
    }
}
