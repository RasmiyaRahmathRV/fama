<?php

namespace App\Http\Controllers;

use App\Exports\PaymentModeExport;
use App\Models\PaymentMode;
use App\Services\CompanyService;
use App\Services\PaymentModeService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class PaymentModeController extends Controller
{
    public function __construct(
        protected PaymentModeService $paymentModeService,
        protected CompanyService $companyService,
    ) {}

    public function index()
    {
        $title = 'Payment Modes';
        $companies = $this->companyService->getAll();

        return view("admin.payment_mode", compact("title", "companies"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            if ($request->id != 0) {
                $payment_mode = $this->paymentModeService->update($request->id, $request->all());

                return response()->json(['success' => true, 'data' => $payment_mode, 'message' => 'Payment mode updated successfully'], 200);
            } else {
                $payment_mode = $this->paymentModeService->createOrRestore($request->all());

                return response()->json(['success' => true, 'data' => $payment_mode, 'message' => 'Payment mode created successfully'], 201);
            }
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) { // integrity constraint violation
                throw ValidationException::withMessages([
                    'payment_mode_name' => 'This payment mode already exists for this company.',
                ]);
            } else {
                return response()->json(['success' => false, 'message' => $e->getMessage(), 'error'   => $e], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentMode $paymentMode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentMode $paymentMode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentMode $paymentMode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentMode $paymentMode)
    {
        $this->paymentModeService->delete($paymentMode->id);
        return response()->json(['success' => true, 'message' => 'Payment mosw soft deleted']);
    }

    public function getPaymentModes(Request $request)
    {
        if ($request->ajax()) {
            $filters = [
                // 'company_id' => $request->company_id,
                'search' => $request->search['value'] ?? null
            ];
            return $this->paymentModeService->getDataTable($filters);
        }
    }

    public function exportPaymentModes(Request $request)
    {
        $search = request('search');

        return Excel::download(new PaymentModeExport($search), 'payment_modes.xlsx');
    }

    public function importPaymentMode(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        $file = $request->file('file');

        // Pass a second argument as required by importExcel, e.g., the current user ID or null if not needed
        $count = $this->paymentModeService->importExcel($file, auth()->user()->id);

        return redirect()->back()->with('success', "$count payment mode imported successfully.");
    }
}
