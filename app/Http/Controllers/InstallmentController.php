<?php

namespace App\Http\Controllers;

use App\Exports\InstallmentExport;
use App\Models\Installment;
use App\Services\CompanyService;
use App\Services\InstallmentService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class InstallmentController extends Controller
{
    public function __construct(
        protected InstallmentService $installmentService,
        protected CompanyService $companyService,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Installments';
        $companies = $this->companyService->getAll();

        return view("admin.master.installment", compact("title", "companies"));
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
                $installment = $this->installmentService->update($request->id, $request->all());

                return response()->json(['success' => true, 'data' => $installment, 'message' => 'Installment updated successfully'], 200);
            } else {
                $installment = $this->installmentService->createOrRestore($request->all());

                return response()->json(['success' => true, 'data' => $installment, 'message' => 'Installment created successfully'], 201);
            }
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) { // integrity constraint violation
                throw ValidationException::withMessages([
                    'installment_name' => 'This installment name already exists for this company.',
                ]);
            } else {
                return response()->json(['success' => false, 'message' => $e->getMessage(), 'error'   => $e], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Installment $installment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Installment $installment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Installment $installment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Installment $installment)
    {
        $this->installmentService->delete($installment->id);
        return response()->json(['success' => true, 'message' => 'Installment soft deleted']);
    }

    /**
     * get the complete active resource from storage.
     */
    public function getInstallments(Request $request)
    {
        if ($request->ajax()) {
            $filters = [
                'company_id' => auth()->user()->company_id,
                'search' => $request->search['value'] ?? null
            ];
            return $this->installmentService->getDataTable($filters);
        }
    }

    public function importInstallment(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        $file = $request->file('file');

        // Pass a second argument as required by importExcel, e.g., the current user ID or null if not needed
        $count = $this->installmentService->importExcel($file, auth()->user()->id);

        return redirect()->back()->with('success', "$count installment imported successfully.");
    }

    public function exportInstallments(Request $request)
    {
        $search = request('search');
        $filters = auth()->user()->company_id ? [
            'company_id' => auth()->user()->company_id,
        ] : null;

        return Excel::download(new InstallmentExport($search, $filters), 'installments.xlsx');
    }
}
