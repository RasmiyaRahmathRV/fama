<?php

namespace App\Http\Controllers;

use App\Exports\ContractExport;
use App\Models\Bank;
use App\Models\Contract;
use App\Models\ContractType;
use App\Models\Industry;
use App\Models\Installment;
use App\Models\PaymentMode;
use App\Models\PropertySizeUnit;
use App\Models\UnitSizeUnit;
use App\Models\UnitStatus;
use App\Models\UnitType;
use App\Services\AreaService;
use App\Services\CompanyService;
use App\Services\Contracts\ContractService;
use Illuminate\Http\Request;
use App\Services\InstallmentService;
use App\Services\LocalityService;
use App\Services\PropertyService;
use App\Services\PropertyTypeService;
use App\Services\VendorService;
use Maatwebsite\Excel\Facades\Excel;

class ContractController extends Controller
{
    //
    public function __construct(
        protected PropertyService $propertyService,
        protected CompanyService $companyService,
        protected LocalityService $localityService,
        protected AreaService $areaService,
        protected PropertyTypeService $propertyTypeService,
        protected InstallmentService $installmentService,
        protected VendorService $vendorService,
        protected ContractService $contractService
    ) {}

    public function index()
    {
        $title = 'Contracts';

        return view("admin.projects.contract.contract", compact("title"));
    }

    public function create()
    {
        $title = 'Create Contract';
        $contract = null;
        // dropdown values
        $dropdowns = $this->contractService->getDropdownData();
        // dd($dropdowns);

        return view("admin.projects.contract.contract-create", compact("title", 'contract') + $dropdowns);
    }

    public function edit($id)
    {
        $title = 'Edit Contract';
        $contract = $this->contractService->getAllDataById($id);
        // dd($contract->contract_detail);
        $dropdowns = $this->contractService->getDropdownData();

        return view('admin.projects.contract.contract-create', compact('title', 'contract') + $dropdowns);
    }

    public function store(Request $request)
    {
        try {
            // if ($request->contract['id'] != 0) {
            //     $contract = $this->contractService->update($request->contract['id'], $request->all());

            //     return response()->json(['success' => true, 'data' => $contract, 'message' => 'Contract updated successfully'], 200);
            // } else {
            $contract = $this->contractService->createOrRestore($request->all());

            return response()->json(['success' => true, 'data' => $contract, 'message' => 'Contract created successfully'], 201);
            // }
        } catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => $e->getMessage(), 'error'   => $e], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $contract = $this->contractService->update($id, $request->all());

            return response()->json(['success' => true, 'data' => $contract, 'message' => 'Contract updated successfully'], 200);
        } catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => $e->getMessage(), 'error'   => $e], 500);
        }
    }

    public function show(Contract $contract)
    {
        $contract = $this->contractService->getById($contract->id);
        return view('admin.projects.contract.contract-view', compact('contract'));
    }

    public function approveContract(Request $request) {}
    public function rejectContract(Request $request) {}

    public function getContracts(Request $request)
    {
        if ($request->ajax()) {
            $filters = [
                'company_id' => auth()->user()->company_id,
                'search' => $request->search['value'] ?? null
            ];
            return $this->contractService->getDataTable($filters);
        }
    }

    public function destroy(Contract $contract)
    {
        $this->contractService->delete($contract->id);
        return response()->json(['success' => true, 'message' => 'Contract deleted successfully']);
    }

    public function contract_documents()
    {
        $title = 'Contract Documents';
        return view("admin.projects.contract.contract-documents", compact("title"));
    }
    public function document_upload(Request $request) {}

    public function exportContract(Contract $contract)
    {
        $search = request('search');
        $filters = auth()->user()->company_id ? [
            'company_id' => auth()->user()->company_id,
        ] : null;

        return Excel::download(new ContractExport($search, $filters), 'contracts.xlsx');
    }
}
