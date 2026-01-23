<?php

namespace App\Http\Controllers;

use App\Exports\VendorExport;
use App\Models\Vendor;
use App\Models\VendorContractTemplate;
use App\Services\CompanyService;
use App\Services\VendorService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class VendorController extends Controller
{
    public function __construct(
        protected VendorService $vendorService,
        protected CompanyService $companyService,
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Vendors';
        $companies = $this->companyService->getAll();
        $contractTemplates = VendorContractTemplate::all();

        return view("admin.master.vendor", compact("title", "companies", "contractTemplates"));
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
                $vendor = $this->vendorService->update($request->id, $request->all());

                return response()->json(['success' => true, 'data' => $vendor, 'message' => 'Vendor updated successfully'], 200);
            } else {
                $vendor = $this->vendorService->createOrRestore($request->all());

                return response()->json(['success' => true, 'data' => $vendor, 'message' => 'Vendor created successfully'], 201);
            }
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) { // integrity constraint violation
                throw ValidationException::withMessages([
                    'vendor_name' => 'This vendor name already exists for this company.',
                ]);
            } else {
                return response()->json(['success' => false, 'message' => $e->getMessage(), 'error'   => $e], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        //
        return view('admin.master.vendor-view', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        $this->vendorService->delete($vendor->id);
        return response()->json(['success' => true, 'message' => 'Vendor soft deleted']);
    }

    public function getVendors(Request $request)
    {
        if ($request->ajax()) {
            $filters = [
                'company_id' => auth()->user()->company_id,
                'search' => $request->search['value'] ?? null
            ];
            return $this->vendorService->getDataTable($filters);
        }
    }

    public function importVendor(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        $file = $request->file('file');

        // Pass a second argument as required by importExcel, e.g., the current user ID or null if not needed
        $result = $this->vendorService->importExcel($file, auth()->user()->id);

        // return redirect()->back()->with('success', "$count vendor imported successfully.");
        if ($result['inserted'] == 0 && $result['restored'] == 0) {
            return response()->json(['success' => false, 'message' => "No new vendor to import."]);
        } else {
            return response()->json(['success' => true, 'message' => "{$result['inserted']} created, {$result['restored']} restored successfully."]);
        }
    }

    public function exportVendor(Request $request)
    {
        $search = request('search');

        $filters = auth()->user()->company_id ? [
            'company_id' => auth()->user()->company_id,
        ] : null;

        return Excel::download(new VendorExport($search, $filters), 'vendors.xlsx');
    }
}
