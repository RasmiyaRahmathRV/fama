<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Services\Contracts\ContractService;
use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        protected ContractService $contractServ,
        protected DashboardService $dashboardService
    ) {}

    public function index()
    {
        $title = 'Dashboard';
        $renewalCount = $this->contractServ->getRenewalDataCount();

        // Get chart & investment data
        $widgets = $this->dashboardService->widgetsData();
        $data = $this->dashboardService->investmentChart();
        $inventoryData = $this->dashboardService->inventoryChart();
        // dd($inventoryData);

        return view('admin.dashboard', array_merge(
            compact('title', 'renewalCount'),
            $data,
            $widgets,
            $inventoryData
        ));
    }
}
