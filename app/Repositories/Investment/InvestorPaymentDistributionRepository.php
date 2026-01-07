<?php

namespace App\Repositories\Investment;

use App\Models\Investment;
use App\Models\InvestorPaymentDistribution;
use App\Models\InvestorPayout;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;

class InvestorPaymentDistributionRepository
{
    public function all()
    {
        return InvestorPaymentDistribution::all();
    }

    public function find($id)
    {
        return InvestorPaymentDistribution::findOrFail($id);
    }


    public function create($data)
    {
        return InvestorPaymentDistribution::create($data);
    }
    public function update(int $id, array $data)
    {
        $investmentDocument = InvestorPaymentDistribution::findOrFail($id);
        return $investmentDocument->update($data);
    }

    public function getPendings(array $filters = []): Builder
    {
        $today = Carbon::today();
        $nextWeek = Carbon::today()->addDays(7);

        $query = InvestorPayout::query()
            ->with([
                'investor:id,investor_code,investor_name,investor_mobile,payment_mode_id',
                'investment:id,investment_code,next_profit_release_date,next_referral_commission_release_date,terminate_status'
            ])
            ->whereColumn('investor_payouts.payout_amount', '>', 'investor_payouts.amount_paid')
            ->where('investor_payouts.is_processed', 0)
            ->whereHas('investment', function ($q) use ($today, $nextWeek) {
                $q->where('terminate_status', '!=', 2)
                    ->where(function ($dateQuery) use ($today, $nextWeek) {

                        // PROFIT
                        $dateQuery->where(function ($profit) use ($today, $nextWeek) {
                            $profit->whereNotNull('next_profit_release_date')
                                ->whereDate('next_profit_release_date', '<=', $nextWeek);
                        })

                            // COMMISSION
                            ->orWhere(function ($commission) use ($today, $nextWeek) {
                                $commission->whereNotNull('next_referral_commission_release_date')
                                    ->whereDate('next_referral_commission_release_date', '<=', $nextWeek);
                            })

                            // 🔹 PRINCIPAL RETURN (termination requested)
                            ->orWhere(function ($principal) use ($today, $nextWeek) {
                                $principal->where('terminate_status', 1)
                                    ->whereNotNull('next_profit_release_date')
                                    ->whereDate('next_profit_release_date', '<=', $nextWeek);
                            });
                    });
            })
            ->orderBy('investor_payouts.id');


        return $query;
    }
}
