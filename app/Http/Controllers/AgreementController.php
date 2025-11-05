<?php

namespace App\Http\Controllers;

use App\Models\TenantIdentity;
use App\Models\UnitType;
use App\Services\CompanyService;
use App\Services\Contracts\ContractService;
use App\Services\InstallmentService;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class AgreementController extends Controller
{
    //
    public function __construct(
        protected ContractService $contractService,
        protected CompanyService $companyService,
        protected InstallmentService $installmentService,
    ) {}
    public function index()
    {
        return view('admin.projects.agreement.agreement');
    }
    public function create()
    {
        $companies = $this->companyService->getAll();
        $contracts = $this->contractService->getAllwithUnits();
        // dd($contracts);
        $installments = $this->installmentService->getAll();
        $tenantIdentities = TenantIdentity::where('show_status', true)->get();
        $unitTypes = UnitType::all();
        return view('admin.projects.agreement.create-agreement', compact('companies', 'contracts', 'installments', 'unitTypes', 'tenantIdentities'));
    }
}
