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
use App\Services\Agreement\AgreementDocumentService;
use App\Services\Agreement\AgreementService;
use App\Services\Agreement\InvoiceService;
use App\Services\BankService;
use App\Services\CompanyService;
use App\Services\Contracts\ContractService;
use App\Services\InstallmentService;
use App\Services\NationalityService;
use App\Services\PaymentModeService;
use Barryvdh\DomPDF\Facade\Pdf;
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
        protected AgreementService $agreementService,
        protected AgreementDocumentService $agreementDocumentService,
        protected InvoiceService $invoiceService
    ) {}
    public function index()
    {
        // dd("test");

        $title = 'Agreemants';
        // dd("test");

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
    public function show(Agreement $agreement)
    {
        $agreement = $this->agreementService->getDetails($agreement->id);
        // dd($agreement);
        return view('admin.projects.agreement.agreement-view', compact('agreement'));
    }
    public function getAgreements(Request $request)
    {
        // dd("test");
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

    public function print_view($id)
    {
        $agreement = $this->agreementService->getDetails($id);
        $page = 1;
        // dd($agreement);

        // View with admin layout (for on-screen preview)
        return view('admin.projects.agreement.printview-agreement', compact('agreement', 'page'));
    }


    public function print($id)
    {
        // dd($id);
        $agreement = $this->agreementService->getDetails($id);
        $page = 0;

        // Generate PDF (clean, print-friendly)
        $pdf = Pdf::loadView('admin.projects.agreement.pdf-agreement', compact('agreement', 'page'))
            ->setPaper([0, 0, 830, 1400]);

        return $pdf->stream('agreement-' . $agreement->id . '.pdf');
    }
    public function agreementDocuments($id)
    {
        $documents = $this->agreementDocumentService->getDocuments($id);
        $tenantIdentities = TenantIdentity::get();
        $agreementId = $id;
        // dd($documents);
        return view('admin.projects.agreement.agreement_documents', compact('documents', 'tenantIdentities', 'agreementId'));
    }
    public function documentUpload(Request $request, $id)
    {
        $agreement = $this->agreementService->getById($request->agreement_id);
        $data['documents'] = $request->documents;
        $data['added_by'] = auth()->user()->id;
        try {
            $documents =  $this->agreementDocumentService->update(
                $agreement,
                $data['documents'] ?? [],
                $data['added_by']
            );

            return response()->json(['success' => true, 'data' =>  $documents, 'message' => 'Documents added successfully'], 200);
        } catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => $e->getMessage(), 'error'   => $e], 500);
        }
    }
    public function destroy(Agreement $agreement)
    {
        $this->agreementService->delete($agreement->id);
        return response()->json(['success' => true, 'message' => 'Agreement deleted successfully']);
    }
    public function terminate(Request $request)
    {
        try {
            $agreement = $this->agreementService->terminate($request->all());
            return response()->json(['success' => true, 'data' => $agreement, 'message' => 'Agreeament terminated successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage(), 'error'   => $e], 500);
        }
    }
    public function invoice_upload(Request $request)
    {
        // dd($request->all());
        try {
            $upload = $this->invoiceService->upload_invoice($request->all());
            return response()->json(['success' => true, 'data' => $upload, 'message' => 'Invoice Uploaded successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage(), 'error'   => $e], 500);
        }
    }
}
