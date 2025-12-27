<?php

namespace App\Repositories\Investment;

use App\Models\Investment;
use App\Models\InvestorPaymentDistribution;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InvestmentSoaRepository
{
    // public function getQuery(array $filters)
    // {
    //     $from = !empty($filters['from'])
    //         ? Carbon::createFromFormat('d-m-Y', $filters['from'])->startOfDay()
    //         : null;

    //     $to = !empty($filters['to'])
    //         ? Carbon::createFromFormat('d-m-Y', $filters['to'])->endOfDay()
    //         : null;

    //     // $investments = DB::table('investments')
    //     //     ->join('investors', 'investors.id', '=', 'investments.investor_id')
    //     //     ->select([
    //     //         'investments.investment_date as date',
    //     //         DB::raw("'Investment' as account_name"),
    //     //         'investors.investor_name',
    //     //         'investments.investment_amount as credit',
    //     //         DB::raw('0 as debit'),
    //     //     ]);
    //     $investments = Investment::with('investor')
    //         ->select([
    //             'investments.investment_date as date',
    //             DB::raw("'Investment' as account_name"),
    //             'investments.investment_amount as credit',
    //             DB::raw('0 as debit'),
    //         ])
    //         ->get();
    //     $payouts = InvestorPaymentDistribution::with('investor')
    //         ->select([
    //             'investor_payment_distributions.paid_date as date',
    //             DB::raw("'Payout' as account_name"),
    //             DB::raw('0 as credit'),
    //             'investor_payment_distributions.amount_paid as debit',
    //         ])
    //         ->get();

    //     // $payouts = DB::table('investor_payment_distributions')
    //     //     ->join('investors', 'investors.id', '=', 'investor_payment_distributions.investor_id')
    //     //     ->select([
    //     //         'investor_payment_distributions.paid_date as date',
    //     //         DB::raw("'Payout' as account_name"),
    //     //         'investors.investor_name',
    //     //         DB::raw('0 as credit'),
    //     //         'investor_payment_distributions.amount_paid as debit',
    //     //     ]);

    //     if ($from && $to) {
    //         $investments->whereBetween('Investment.investment_date', [$from, $to]);
    //         $payouts->whereBetween('InvestorPaymentDistribution.paid_date', [$from, $to]);
    //     }
    //     // $data = $investments
    //     //     ->unionAll($payouts)
    //     //     ->orderBy('date', 'asc')
    //     //     ->get();
    //     // dd($data);

    //     return $investments
    //         ->unionAll($payouts)
    //         ->orderBy('date', 'asc')
    //         ->get();
    // }

    public function getQuery(array $filters)
    {
        $from = !empty($filters['from'])
            ? Carbon::createFromFormat('d-m-Y', $filters['from'])->startOfDay()
            : null;

        $to = !empty($filters['to'])
            ? Carbon::createFromFormat('d-m-Y', $filters['to'])->endOfDay()
            : null;

        // Fetch investments with investor
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

        // Fetch payouts with investor
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


        // Merge both collections
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
