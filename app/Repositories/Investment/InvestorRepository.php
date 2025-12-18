<?php

namespace App\Repositories\Investment;

use App\Models\Investor;
use Illuminate\Contracts\Database\Eloquent\Builder;

class InvestorRepository
{
    public function all()
    {
        return Investor::all();
    }
    public function allActive()
    {
        return Investor::where('status', 1)->get();
    }


    public function find($id)
    {
        return Investor::findOrFail($id);
    }

    public function getByName($areaData)
    {
        return Investor::where($areaData)->first();
    }

    public function create($data)
    {
        return Investor::create($data);
    }

    public function updateOrRestore(int $id, array $data)
    {
        $area = Investor::withTrashed()->findOrFail($id);

        if ($area->trashed()) {
            $area->restore();
        }

        $area->update($data);

        return $area;
    }

    public function delete($id)
    {
        $area = $this->find($id);
        return $area->delete();
    }

    public function uniqInvestorName($area_name, $company_id)
    {
        return Investor::where('area_name', $area_name)
            ->where('company_id', $company_id)
            ->first();
    }

    public function getByCompany($company_id)
    {
        return Investor::where('company_id', $company_id)->get();
    }

    public function getQuery(array $filters = []): Builder
    {
        $query = Investor::query()
            ->select('areas.*', 'companies.company_name')
            ->join('companies', 'companies.id', '=', 'areas.company_id');

        if (!empty($filters['search'])) {
            $query->orwhere('area_name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('area_code', 'like', '%' . $filters['search'] . '%')
                ->orWhereHas('company', function ($q) use ($filters) {
                    $q->where('company_name', 'like', '%' . $filters['search'] . '%');
                })
                ->orWhereRaw("CAST(areas.id AS CHAR) LIKE ?", ['%' . $filters['search'] . '%']);
        }

        if (!empty($filters['company_id'])) {
            $query->Where('company_id', $filters['company_id']);
        }

        return $query;
    }

    public function checkIfExist($data)
    {
        $existing = Investor::withTrashed()
            ->where('company_id', $data['company_id'])
            ->where('area_name', $data['area_name'])
            ->first();

        if ($existing && $existing->trashed()) {
            // $existing->restore();
            return $existing;
        }
    }

    public function insertBulk(array $rows)
    {
        return Investor::insert($rows); // bulk insert
    }

    public function getInvestorsWithDetails()
    {
        $investors = Investor::with('payoutBatch', 'investorBanks')
            ->where('status', 1)
            ->get();

        return $investors;
    }
}
