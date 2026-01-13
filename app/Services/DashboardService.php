<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Contract;
use App\Models\ContractRental;
use App\Models\Investment;
use App\Models\Investor;
use App\Models\PayoutBatch;
use App\Models\ProfitInterval;
use App\Models\ReferralCommissionFrequency;
use App\Repositories\Investment\InvestmentRepository;
use App\Repositories\Investment\InvestmentSoaRepository;
use App\Repositories\Investment\InvestorRepository;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Carbon;


class DashboardService
{
    public function __construct(
        protected InvestmentRepository $investmentRepository,
        protected InvestorRepository $investorRepository,
        protected InvestmentRepository $investmentReferralRepository,
        protected InvestmentSoaRepository $investmentSoaRepository,

    ) {}

    public function investmentChart()
    {
        // Get last 2 months of investments
        $monthlyData = Investment::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(investment_amount) as total_amount, COUNT(*) as count')
            // ->where('created_at', '>=', now()->subMonths(2))
            ->where('created_at', '<', now())
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $labels = [];
        $amounts = [];
        $counts = [];

        foreach ($monthlyData as $data) {
            $labels[] = date('M', mktime(0, 0, 0, $data->month, 1));
            $amounts[] = (float) $data->total_amount;
            $counts[] = (int) $data->count;
        }

        $totalInvestment = Investment::sum('investment_amount');
        $totalCount = Investment::count();

        $percentageChange = 0;
        $arrowUp = true;
        // dd($monthlyData);
        // dd($monthlyData->count());

        if ($monthlyData->count() >= 2) {
            $lastMonth = $monthlyData[$monthlyData->count() - 2]->total_amount;
            $thisMonth = $monthlyData[$monthlyData->count() - 1]->total_amount;
            // dd($thisMonth, $lastMonth);
            // $test = ($thisMonth / $lastMonth) * 100;
            // dd($test);

            if ($lastMonth > 0) {
                $percentageChange = round((($thisMonth - $lastMonth) / $lastMonth) * 100, 2);
                $arrowUp = $percentageChange >= 0;
            }
        }

        return compact('labels', 'amounts', 'counts', 'totalInvestment', 'totalCount', 'percentageChange', 'arrowUp');
    }
    public function widgetsData()
    {
        $wid_totalContracts = Contract::count();
        $wid_totalInvestors = Investor::count();
        $wid_totalInvestments = Investment::count();
        $wid_revenue = ContractRental::sum('rent_receivable_per_annum');
        return compact('wid_totalContracts', 'wid_totalInvestors', 'wid_totalInvestments', 'wid_revenue');
    }
    // public function inventoryChart()
    // {

    //     $companies = Company::with(['contracts.contract_unit'])->get();

    //     $companyNames = [];
    //     $companyUnits = [];

    //     foreach ($companies as $company) {
    //         $companyNames[] = $company->company_name;

    //         // sum all contract units under this company
    //         $totalUnits = $company->contracts->sum(function ($contract) {
    //             return $contract->contract_unit->no_of_units;
    //         });
    //         // dd($totalUnits);

    //         $companyUnits[] = $totalUnits;
    //     }
    //     dd($companyUnits);

    //     $totalUnits = array_sum($companyUnits);

    //     $percentChange = 10;

    //     return compact('companyNames', 'companyUnits', 'totalUnits', 'percentChange');
    // }


    public function inventoryChart()
    {

        $companies = Company::with(['contracts.contract_unit'])->get();

        $companyNames = [];
        $dfUnits = [];
        $ffUnits = [];
        $totalUnits = [];

        $thisMonthStart = Carbon::now()->startOfMonth();
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd   = Carbon::now()->subMonth()->endOfMonth();

        $thisMonthUnits = 0;
        $lastMonthUnits = 0;

        foreach ($companies as $company) {
            $companyNames[] = $company->company_name;

            $dfTotal = 0;
            $ffTotal = 0;

            foreach ($company->contracts as $contract) {
                $units = $contract->contract_unit->no_of_units ?? 0;

                if ($contract->contract_type_id === 1) {
                    $dfTotal += $units;
                }

                if ($contract->contract_type_id === 2) {
                    $ffTotal += $units;
                }

                if ($contract->created_at >= $thisMonthStart) {
                    $thisMonthUnits += $units;
                }

                if (
                    $contract->created_at >= $lastMonthStart &&
                    $contract->created_at <= $lastMonthEnd
                ) {
                    $lastMonthUnits += $units;
                }
            }

            $dfUnits[] = $dfTotal;
            $ffUnits[] = $ffTotal;
            $totalUnits[] = $dfTotal + $ffTotal;
        }

        $grandTotal = array_sum($totalUnits);

        $difference = $thisMonthUnits - $lastMonthUnits;

        $percentChange = $lastMonthUnits > 0
            ? round(($difference / $lastMonthUnits) * 100, 2)
            : 100;

        $arrow = $difference > 0
            ? 'up'
            : ($difference < 0 ? 'down' : 'same');

        return compact(
            'companyNames',
            'dfUnits',
            'ffUnits',
            'totalUnits',
            'grandTotal',
            'thisMonthUnits',
            'lastMonthUnits',
            'difference',
            'percentChange',
            'arrow'
        );
    }
}
