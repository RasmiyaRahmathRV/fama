<?php

namespace App\Repositories\Investment;

use App\Models\InvestmentDocument;
use Illuminate\Contracts\Database\Eloquent\Builder;

class InvestmentDocumentRepository
{
    public function all()
    {
        return InvestmentDocument::all();
    }

    public function find($id)
    {
        return InvestmentDocument::findOrFail($id);
    }


    public function create($data)
    {
        return InvestmentDocument::create($data);
    }
}
