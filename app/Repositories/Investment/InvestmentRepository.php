<?php

namespace App\Repositories\Investment;

use App\Models\Investment;
use App\Models\InvestmentReceivedPayment;
use Illuminate\Contracts\Database\Eloquent\Builder;

class InvestmentRepository
{
    public function all()
    {
        return Investment::all();
    }

    public function find($id)
    {
        return Investment::findOrFail($id);
    }
    public function getWithDetails($id)
    {
        return Investment::with([
            'investor.investorBanks',
            'company.banks',
            'profitInterval',
            'payoutBatch',
        ])->findOrFail($id);
    }


    public function getByName($areaData)
    {
        return Investment::where($areaData)->first();
    }

    public function create($data)
    {
        return Investment::create($data);
    }
    public function updateById(int $id, array $data)
    {
        $investment = Investment::findOrFail($id);
        return $investment->update($data);
    }

    public function updateOrRestore(int $id, array $data)
    {
        $area = Investment::withTrashed()->findOrFail($id);

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

    public function uniqInvestmentName($area_name, $company_id)
    {
        return Investment::where('area_name', $area_name)
            ->where('company_id', $company_id)
            ->first();
    }

    public function getByCompany($company_id)
    {
        return Investment::where('company_id', $company_id)->get();
    }

    public function getQuery(array $filters = []): Builder
    {
        $query = Investment::with('investor', 'payoutBatch');
        $result = $query->get();
        // dd($result);
        // if (!empty($filters['search'])) {
        //     $query->orwhere('area_name', 'like', '%' . $filters['search'] . '%')
        //         ->orWhere('area_code', 'like', '%' . $filters['search'] . '%')
        //         ->orWhereHas('company', function ($q) use ($filters) {
        //             $q->where('company_name', 'like', '%' . $filters['search'] . '%');
        //         })
        //         ->orWhereRaw("CAST(areas.id AS CHAR) LIKE ?", ['%' . $filters['search'] . '%']);
        // }

        // if (!empty($filters['company_id'])) {
        //     $query->Where('company_id', $filters['company_id']);
        // }

        return $query;
    }

    public function getTotalReceivedAmount($investment)
    {
        return InvestmentReceivedPayment::where('investment_id', $investment->id)
            ->sum('received_amount');
    }

    public function insertBulk(array $rows)
    {
        return Investment::insert($rows);
    }
}
