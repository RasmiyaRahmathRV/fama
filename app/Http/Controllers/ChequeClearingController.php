<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\PaymentMode;
use App\Repositories\TenantChequeRepository;
use App\Services\CompanyService;
use App\Services\TenantChequeService;
use Illuminate\Http\Request;

class ChequeClearingController extends Controller
{
    public function __construct(
        protected TenantChequeService $tenantChequeService,
        protected TenantChequeRepository $tenantChequeRepository,
        protected CompanyService $companyService
    ) {}
    public function vendorChequeClearing()
    {
        // dd('test');
        return view('admin.finance.vendor-cheque-clearing');
    }
    public function receivableChequeClearing()
    {
        $payment_modes = PaymentMode::all();
        $banks = Bank::all();
        $companies = $this->companyService->getWithIndustry();
        $properties = getPropertiesHaveContract();
        $units = getUnitshaveAgreement();
        $agpaymentmodes = getPaymentModeHaveAgreement();
        // dd($units);
        $units = getUnitshaveAgreement();
        return view('admin.finance.tenant-cheque-clearing', compact('payment_modes', 'banks', 'companies', 'properties', 'agpaymentmodes', 'units'));
    }
    public function receivableChequeClearingList(Request $request)
    {
        // dd("test");
        // dd($request->all());
        // dd($request->company_id);
        if ($request->ajax()) {
            $filters = [
                'company_id'  => $request->company_id,
                'search'      => $request->search['value'] ?? null,
                'date_from'   => $request->date_from ?? null,
                'date_to'     => $request->date_to ?? null,
                'property_id' => $request->property_id ?? null,
                'unit_id'     => $request->unit_id ?? null,
                'mode_id' => $request->mode_id ?? null,
            ];

            return $this->tenantChequeService->getDataTable($filters);
        }
    }
    public function receivableChequeClearSubmit(Request $request)
    {
        // dd($request->all());
        try {
            $receivable = $this->tenantChequeService->clearReceivable($request->all());

            return response()->json(['success' => true, 'data' => $receivable, 'message' => 'Payment cleared successfully and receivable updated.'], 200);
        } catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => $e->getMessage(), 'error'   => $e], 500);
        }
    }
}
