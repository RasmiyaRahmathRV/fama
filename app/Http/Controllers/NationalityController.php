<?php

namespace App\Http\Controllers;

use App\Exports\NationalityExport;
use App\Exports\PaymentModeExport;
use App\Models\Nationality;
use App\Services\CompanyService;
use App\Services\NationalityService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class NationalityController extends Controller
{
    public function __construct(
        protected NationalityService $nationalityService,
        protected CompanyService $companyService,
    ) {}

    public function index()
    {
        $title = 'Nationalities';
        $companies = $this->companyService->getAll();

        return view("admin.nationality", compact("title", "companies"));
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
                $nationality = $this->nationalityService->update($request->id, $request->all());

                return response()->json(['success' => true, 'data' => $nationality, 'message' => 'Nationality updated successfully'], 200);
            } else {
                $nationality = $this->nationalityService->createOrRestore($request->all());

                return response()->json(['success' => true, 'data' => $nationality, 'message' => 'Nationality created successfully'], 201);
            }
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) { // integrity constraint violation
                throw ValidationException::withMessages([
                    'nationality_name' => 'This nationality already exists for this company.',
                ]);
            } else {
                return response()->json(['success' => false, 'message' => $e->getMessage(), 'error'   => $e], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Nationality $nationality)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nationality $nationality)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nationality $nationality)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nationality $nationality)
    {
        $this->nationalityService->delete($nationality->id);
        return response()->json(['success' => true, 'message' => 'Nationality soft deleted']);
    }

    public function getNationalities(Request $request)
    {
        if ($request->ajax()) {
            $filters = [
                // 'company_id' => $request->company_id,
                'search' => $request->search['value'] ?? null
            ];
            return $this->nationalityService->getDataTable($filters);
        }
    }

    public function exportNationalities(Request $request)
    {
        $search = request('search');

        return Excel::download(new NationalityExport($search), 'nationalities.xlsx');
    }

    public function importNationality(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        $file = $request->file('file');

        // Pass a second argument as required by importExcel, e.g., the current user ID or null if not needed
        $count = $this->nationalityService->importExcel($file, auth()->user()->id);

        return redirect()->back()->with('success', "$count nationality imported successfully.");
    }
}
