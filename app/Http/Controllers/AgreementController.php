<?php

namespace App\Http\Controllers;

use App\Exports\AgreementExport;
use App\Models\Agreement;
use App\Models\Bank;
use App\Models\ContractType;
use App\Models\Installment;
use App\Models\PaymentMode;
use App\Models\TenantIdentity;
use App\Models\UnitType;
use App\Services\Agreement\AgreementService;
use App\Services\BankService;
use App\Services\CompanyService;
use App\Services\Contracts\ContractService;
use App\Services\InstallmentService;
use App\Services\NationalityService;
use App\Services\PaymentModeService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class AgreementController extends Controller
{
    //
    public function __construct(
        protected ContractService $contractService,
        protected CompanyService $companyService,
        protected InstallmentService $installmentService,
        protected NationalityService $nationalityService,
        protected PaymentModeService $paymentModeService,
        protected BankService $bankService,
        protected AgreementService $agreementService
    ) {}
    public function index()
    {
        $title = 'Agreemants';

        return view("admin.projects.agreement.agreement", compact("title"));
    }
    public function create()
    {
        $companies = $this->companyService->getAll();
        $contracts = $this->contractService->getAllwithUnits();
        // dd($contracts);
        $installments = $this->installmentService->getAll();
        $tenantIdentities = TenantIdentity::where('show_status', true)->get();
        $unitTypes = UnitType::all();
        $paymentmodes = $this->paymentModeService->getAll();
        $installments = $this->installmentService->getAll();
        $banks = $this->bankService->getAll();
        $nationalities = $this->nationalityService->getAll();
        $contractTypes = ContractType::all();


        // dd($contractTypes);

        // dd($contracts);
        return view('admin.projects.agreement.create-agreement', compact('companies', 'contracts', 'installments', 'unitTypes', 'tenantIdentities', 'paymentmodes', 'banks', 'nationalities', 'contractTypes'));
    }
    public function store(Request $request)
    {
        // dd($request->all());

        try {

            $agreement = $this->agreementService->createOrRestore($request->all());


            return response()->json(['success' => true, 'data' => $agreement, 'message' => 'Agreeament created successfully'], 201);
            // }
        } catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => $e->getMessage(), 'error'   => $e], 500);
        }
    }
    public function show(Agreement $agreemant)
    {
        $contract = $this->agreementService->getById($agreemant->id);
        return view('admin.projects.contract.contract-view', compact('contract'));
    }
    public function getAgreements(Request $request)
    {
        if ($request->ajax()) {
            $filters = [
                'company_id' => auth()->user()->company_id,
                'search' => $request->search['value'] ?? null
            ];
            return $this->agreementService->getDataTable($filters);
        }
    }
    public function exportAgreement(Agreement $agreement)
    {
        $search = request('search');
        $filters = auth()->user()->company_id ? [
            'company_id' => auth()->user()->company_id,
        ] : null;

        return Excel::download(new AgreementExport($search, $filters), 'agreements.xlsx');
    }
    public function edit(Agreement $agreement)
    {
        $agreement = $this->agreementService->getById($agreement->id);
        // dd($agreement);

        $companies = $this->companyService->getAll();
        $contracts = $this->contractService->getAllwithUnits();
        $fullContracts = $this->contractService->fullContracts();
        // dd($fullContracts);
        $installments = $this->installmentService->getAll();
        $tenantIdentities = TenantIdentity::where('show_status', true)->get();
        $unitTypes = UnitType::all();
        $paymentmodes = $this->paymentModeService->getAll();
        $banks = $this->bankService->getAll();
        $nationalities = $this->nationalityService->getAll();
        $contractTypes = ContractType::all();

        return view('admin.projects.agreement.create-agreement', compact(
            'agreement',
            'companies',
            'contracts',
            'installments',
            'unitTypes',
            'tenantIdentities',
            'paymentmodes',
            'banks',
            'nationalities',
            'contractTypes',
            'fullContracts'
        ));
    }
    public function update(Request $request, $id)
    {
        // dd($id);
        // dd($request->all());
        try {
            $agreement = $this->agreementService->update($id, $request->all());

            return response()->json(['success' => true, 'data' => $agreement, 'message' => 'Agreemant updated successfully'], 200);
        } catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => $e->getMessage(), 'error'   => $e], 500);
        }
    }

    public function print_view(Agreement $agreement)
    {
        return view("admin.projects.agreement.printview-agreement");
    }
}
