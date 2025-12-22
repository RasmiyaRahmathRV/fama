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
            ->with([
                'nationality',
                'paymentMode',
                'countryOfResidence',
                'payoutBatch',
                'referral',
                'investorBanks'
            ]);



        // if (!empty($filters['filter'])) {
        //     $filter = $filters['filter'];

        //     // Vendor filter
        //     if ($filter['vendor_id']) {
        //         $query->whereHas('contract', function ($q) use ($filter) {
        //             $q->where('vendor_id', $filter['vendor_id']);
        //         });
        //     }

        //     // property filter
        //     if ($filter['property_id']) {
        //         $query->whereHas('contract', function ($q) use ($filter) {
        //             $q->where('property_id', $filter['property_id']);
        //         });
        //     }

        //     // payment mode filter
        //     if ($filter['payment_mode']) {
        //         $query->whereHas('payment_mode', function ($q) use ($filter) {
        //             $q->where('payment_mode_id', $filter['payment_mode']);
        //         });
        //     }

        //     if (!empty($filter['date_from'])) {
        //         $fromDate = $filter['date_from'];
        //     }

        //     if (!empty($filter['date_to'])) {
        //         $todate = $filter['date_to'];
        //     }
        // }

        // if ($fromDate) {
        //     $query->whereBetween('payment_date', [
        //         $fromDate,
        //         $todate
        //     ]);
        // } else {
        //     $query->where(
        //         'payment_date',
        //         '<=',
        //         $todate
        //     );
        // }


        if (!empty($filters['search'])) {
            $search = trim($filters['search']);
            $searchLike = str_replace('-', '%', $search);

            $query->where(function ($q) use ($search, $searchLike) {
                $q->whereRaw('payment_date LIKE ?', ["%{$searchLike}%"])
                    ->orWhereRaw("CAST(payment_amount AS CHAR) LIKE ?", ["%{$search}%"])


                    ->orWhereHas('contract', function ($q) use ($search) {
                        $q->orwhere('project_code', 'like', '%' . $search . '%')
                            ->orWhere('project_number', 'like', '%' . $search . '%');
                    })

                    ->orWhereHas('contract.company', function ($q) use ($search) {
                        $q->where('company_name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('contract.contract_type', function ($q) use ($search) {
                        $q->where('contract_type', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('contract.property', function ($q) use ($search) {
                        $q->where('property_name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('contract.vendor', function ($q) use ($search) {
                        $q->where('vendor_name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('payment_mode', function ($q) use ($search) {
                        $q->where('payment_mode_name', 'like', '%' . $search . '%');
                    });
            });
        }

        return $query;
    }

    public function insertBulk(array $rows)
    {
        return Investor::insert($rows); // bulk insert
    }

    public function getInvestorsWithDetails()
    {
        $investors = Investor::with('payoutBatch', 'investorBanks', 'referral')
            ->where('status', 1)
            ->get();

        return $investors;
    }
}
