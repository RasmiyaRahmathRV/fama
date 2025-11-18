<?php

namespace App\Http\Controllers;

use App\Exports\ArrayToSheetExport;
use App\Exports\ContractExport;
use App\Exports\ProjectScopeExport;
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
use App\Services\Contracts\PaymentDetailService;
use App\Services\Contracts\PaymentReceivableService;
use App\Services\Contracts\ProjectScopeDataService;
use App\Services\Contracts\UnitDetailService;
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
        protected ContractService $contractService,
        protected UnitDetailService $udetSev,
        protected PaymentDetailService $paymentSev,
        protected PaymentReceivableService $paymentRecSev,
        protected ProjectScopeDataService $scopeService
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
        $renew = 0;
        $edit = 0;
        // dropdown values
        $dropdowns = $this->contractService->getDropdownData();
        // dd($dropdowns);

        return view("admin.projects.contract.contract-create", compact("title", 'contract', 'renew', 'edit') + $dropdowns);
    }

    public function edit($id)
    {
        $title = 'Edit Contract';
        $contract = $this->contractService->getAllDataById($id);
        $renew = 0;
        $edit = 1;
        // dd($contract->contract_detail);
        $dropdowns = $this->contractService->getDropdownData();

        return view('admin.projects.contract.contract-create', compact('title', 'contract', 'renew', 'edit') + $dropdowns);
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
        $allChildren = $this->contractService->getAllChildren($contract->id);
        // dd($allChildren);
        return view('admin.projects.contract.contract-view', compact('contract', 'allChildren'));
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

    public function contract_documents($contractId)
    {
        $title = 'Contract Documents';
        $contract = $this->contractService->getById($contractId);
        return view("admin.projects.contract.contract-documents", compact("title", 'contract'));
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

    public function deleteUnitDetail($id)
    {
        // print($id);
        try {
            $this->udetSev->delete($id);

            return response()->json([
                'success' => true,
                'message' => 'Unit detail deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function deletePaymentDetail($id)
    {
        // print($id);
        try {
            $this->paymentSev->delete($id);

            return response()->json([
                'success' => true,
                'message' => 'Payment Payable deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function deletePaymentReceivable($id)
    {
        try {
            $this->paymentRecSev->delete($id);

            return response()->json([
                'success' => true,
                'message' => 'Payment Payable deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function getRenewalPendingContracts()
    {
        $title = 'Renewal Pendings';

        return view("admin.projects.contract.contract-renewal-list", compact("title"));
    }

    public function getRenewalContractsList(Request $request)
    {
        if ($request->ajax()) {
            $filters = [
                'company_id' => auth()->user()->company_id,
                'search' => $request->search['value'] ?? null
            ];
            return $this->contractService->getRenewalDataTable($filters);
        }
    }

    public function renewContracts($contract_id)
    {
        $renew = 1;
        $edit = 0;
        $contract = $this->contractService->getAllDataById($contract_id);
        $title = 'Renew Contract P-' . $contract->project_number;
        $dropdowns = $this->contractService->getDropdownData();

        return view('admin.projects.contract.contract-create', compact('contract', 'renew', 'title', 'edit') + $dropdowns);
    }

    public function rejectRenewal(Request $request, $contract_id)
    {
        try {
            $this->contractService->rejectRenew($request, $contract_id);

            return response()->json([
                'success' => true,
                'message' => 'Renew rejected successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function exportBuildingSummary($id)
    {
        $contract = $this->contractService->getAllDataById($id);
        $file_name = "Project " . $contract->project_number . (($contract->contract_type_id == 1) ? '_Direct' : '') . (($contract->parent_contract_id) ? '_Renewal' : '') . '_' . $contract->property->property_name . ' Building Summary.xlsx';


        // Generate temporary signed URL valid for a few seconds
        $downloadUrl = route('contract.downloadSummary', [
            'id' => $id,
            'filename' => urlencode($file_name)
        ]);

        return response()->json([
            'file_url' => $downloadUrl,
            'redirect_url' => route('contract.index')
        ]);
    }

    public function downloadSummary($contractId, $filename)
    {
        // dd('downloadsummary');
        // return;
        return Excel::download(new ProjectScopeExport($contractId, $this->scopeService), $filename);
    }

    public function downloadScope($id)
    {
        $scopeData = $this->scopeService->getScope($id);
        $binaryExcel = base64_decode($scopeData['scope']);
        // dd($binaryExcel);
        return response()->stream(function () use ($binaryExcel) {
            echo $binaryExcel;
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $scopeData['file_name'] . '"',
            'Cache-Control' => 'max-age=0',
        ]);

        // $retData  = $this->scopeService->getScope($id);
        // dd(gettype($retData));
        // $sheetdata = $retData['sheetdata'];
        // $filename = $retData['filename'];

        // return $retData;

        // return Excel::download(new ArrayToSheetExport($sheetdata), $filename . '.xlsx');
    }
}
