<?php

namespace App\Repositories\Investment;

use App\Models\Investment;
use App\Models\InvestorPaymentDistribution;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InvestmentSoaRepository
{


    public function getQuery(array $filters)
    {
        $from = !empty($filters['from'])
            ? Carbon::createFromFormat('d-m-Y', $filters['from'])->startOfDay()
            : null;

        $to = !empty($filters['to'])
            ? Carbon::createFromFormat('d-m-Y', $filters['to'])->endOfDay()
            : null;

        $investments = Investment::with('investor')
            ->when($from && $to, function ($q) use ($from, $to) {
                $q->whereBetween('investment_date', [$from, $to]);
            })
            ->get()
            ->map(function ($inv) {
                return [
                    'date' => $inv->investment_date,
                    'account_name' => 'Investment',
                    'investor_name' => $inv->investor->investor_name ?? '-',
                    'credit' => $inv->investment_amount,
                    'debit' => 0,
                ];
            });

        $payouts = InvestorPaymentDistribution::with('investor')
            ->when($from && $to, function ($q) use ($from, $to) {
                $q->whereBetween('paid_date', [$from, $to]);
            })
            ->get()
            ->map(function ($pay) {
                return [
                    'date' => $pay->paid_date,
                    'account_name' => 'Payout',
                    'investor_name' => $pay->investor->investor_name ?? '-',
                    'credit' => 0,
                    'debit' => $pay->amount_paid,
                ];
            });



        $soa = $investments->merge($payouts)
            ->sortBy('date')
            ->values();
        // dd($soa);
        if (!empty($filters['search'])) {
            $search = strtolower($filters['search']);
            $soa = $soa->filter(
                fn($row) =>
                str_contains(strtolower($row['investor_name']), $search) ||
                    str_contains(strtolower($row['account_name']), $search) ||
                    str_contains((string)$row['credit'], $search) ||
                    str_contains((string)$row['debit'], $search) ||
                    str_contains(\Carbon\Carbon::parse($row['date'])->format('d-m-Y'), $search)
            )->values();
        }

        return $soa;
    }
}
