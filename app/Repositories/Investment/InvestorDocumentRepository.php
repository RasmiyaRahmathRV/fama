<?php

namespace App\Repositories\Investment;

use App\Models\InvestorDocument;
use Illuminate\Contracts\Database\Eloquent\Builder;

class InvestorDocumentRepository
{
    public function all()
    {
        return InvestorDocument::all();
    }

    public function allActive()
    {
        return InvestorDocument::where('status', 1)->get();
    }

    public function find($id)
    {
        return InvestorDocument::findOrFail($id);
    }

    public function getByName($investorDocData)
    {
        return InvestorDocument::where($investorDocData)->first();
    }

    public function create($data)
    {
        return InvestorDocument::create($data);
    }

    public function createMany(array $dataArray)
    {
        $detId = [];
        foreach ($dataArray as $data) {
            $detId[] = InvestorDocument::create($data);
        }
        return  $detId;
    }

    public function updateOrRestore(int $id, array $data)
    {
        $investorDoc = InvestorDocument::withTrashed()->findOrFail($id);
        $investorDoc->update($data);

        return $investorDoc;
    }

    public function delete($id)
    {
        $investorDoc = $this->find($id);
        return $investorDoc->delete();
    }
}
