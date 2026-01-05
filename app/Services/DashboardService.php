<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Contract;
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

    public function inventoryChart()
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

        // Total investment sum
        $totalInvestment = Investment::sum('investment_amount');

        // Total number of investments
        $totalCount = Investment::count();

        // Calculate % change from previous month
        $lastMonthAmount = $monthlyData->count() >= 2 ? $monthlyData[$monthlyData->count() - 2]->total_amount : 0;
        $thisMonthAmount = $monthlyData->count() >= 1 ? $monthlyData[$monthlyData->count() - 1]->total_amount : 0;

        $percentageChange = $lastMonthAmount > 0
            ? round((($thisMonthAmount - $lastMonthAmount) / $lastMonthAmount) * 100, 2)
            : 0;

        // Determine arrow up or down
        $arrowUp = $percentageChange >= 0;

        return compact('labels', 'amounts', 'counts', 'totalInvestment', 'totalCount', 'percentageChange', 'arrowUp');
    }
    public function widgetsData()
    {
        $wid_totalContracts = Contract::count();
        $wid_totalInvestors = Investor::count();
        $wid_totalInvestments = Investment::count();
        return compact('wid_totalContracts', 'wid_totalInvestors', 'wid_totalInvestments');
    }
}
