<?php

namespace App\Repositories\Investment;

use App\Models\Investor;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

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

    public function getByName($investorData)
    {
        return Investor::where($investorData)->first();
    }

    public function create($data)
    {
        return Investor::create($data);
    }

    public function update(int $id, array $data)
    {
        $investor = Investor::findOrFail($id);
        $investor->update($data);

        return $investor;
    }

    public function delete($id)
    {
        $investor = $this->find($id);
        $investor->deleted_by = auth()->user()->id;
        return $investor->delete();
    }

    public function uniqInvestorName($investor_name, $company_id)
    {
        return Investor::where('area_name', $investor_name)
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


        if (!empty($filters['search'])) {
            $search = trim($filters['search']);
            $searchLike = str_replace('-', '%', $search);

            $query->where(function ($q) use ($search, $searchLike) {
                $q->where('investor_name LIKE ?', '%' . $search . '%')
                    ->orWhere("investor_mobile  LIKE ?", '%' . $search . '%')
                    ->orWhere('investor_email  LIKE ?', '%' . $search . '%')
                    ->orWhere('id_number LIKE ?', '%' . $search . '%')
                    ->orWhere('passport_number LIKE ?', '%' . $search . '%')
                    ->orWhereRaw('profit_release_date  LIKE ?', '%' . $searchLike . '%')

                    ->orWhereHas('nationality', function ($q) use ($search) {
                        $q->orwhere('nationality_name', 'like', '%' . $search . '%');
                    })

                    ->orWhereHas('payoutBatch', function ($q) use ($search) {
                        $q->where('batch_name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('paymentMode', function ($q) use ($search) {
                        $q->where('payment_mode_name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('investorBanks', function ($q) use ($search) {
                        $q->where('investor_beneficiary', 'like', '%' . $search . '%')
                            ->where('investor_bank_name', 'like', '%' . $search . '%')
                            ->where('investor_iban', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('referral', function ($q) use ($search) {
                        $q->where('investor_name', 'like', '%' . $search . '%');
                    });
            });

            $query = '';
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
    public function updateOnInvestmentDelete($id, $investment)
    {
        DB::transaction(function () use ($id, $investment) {

            $investor = Investor::find($id);

            // Decrement total investments
            if ($investor->total_no_of_investments > 0) {
                $investor->total_no_of_investments -= 1;
            }

            // Decrement invested amount
            if ($investor->total_invested_amount > 0) {
                $investor->total_invested_amount -= $investment->investment_amount;
            }

            $investor->save();

            // Handle referral
            if ($investment->investmentReferral) {
                $investor_referrer_id = $investment->investmentReferral->investor_referror_id;
                $commission_amount    = $investment->investmentReferral->referral_commission_amount;

                $referrer = Investor::find($investor_referrer_id);

                if ($referrer && $referrer->total_referal_commission > 0) {
                    $referrer->total_referal_commission -= $commission_amount;
                    $referrer->save();
                }
            }
        });
    }
}
