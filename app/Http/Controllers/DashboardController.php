<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Services\Contracts\ContractService;
use App\Services\DashboardService;
use App\Services\PropertyService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        protected ContractService $contractServ,
        protected DashboardService $dashboardService,
        protected PropertyService $propertService
    ) {}

    public function index()
    {
        $title = 'Dashboard';
        $renewalCount = $this->contractServ->getRenewalDataCount();

        // Get chart & investment data
        $widgets = $this->dashboardService->widgetsData();
        $data = $this->dashboardService->investmentChart();
        $inventoryData = $this->dashboardService->inventoryChart();
        $properties = $this->propertService->getAll();
        $topInvestors = $this->dashboardService->toIinvestorChart();
        // dd($inventoryData);
        // dd($properties);

        return view('admin.dashboard', array_merge(
            compact('title', 'renewalCount', 'properties'),
            $data,
            $widgets,
            $inventoryData,
            $topInvestors
        ));
    }
}
