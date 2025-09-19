<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Locality;
use App\Services\CompanyService;
use App\Services\LocalityService;
use Illuminate\Http\Request;

class LocalityController extends Controller
{
    protected $localityService;
    protected $companyService;

    public function __construct(LocalityService $localityService, CompanyService $companyService)
    {
        $this->localityService = $localityService;
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Locality';
        $areas = Area::all();
        $companies = $this->companyService->getAll();
        return view("admin.locality", compact("companies", "areas"));
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
                $locality = $this->localityService->update($request->id, $request->all());

                return response()->json(['success' => true, 'data' => $locality, 'message' => 'Locality updated successfully'], 200);
            } else {
                $locality = $this->localityService->create($request->all());

                return response()->json(['success' => true, 'data' => $locality, 'message' => 'Locality created successfully'], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage(), 'error'   => $e], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Locality $locality)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Locality $locality)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Locality $locality)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Locality $locality)
    {
        //
    }

    public function export()
    {
        // $search = request('search');

        // return Excel::download(new LocalityExport($search), 'areas.xlsx');
    }

    public function getLocalities(Request $request)
    {
        if ($request->ajax()) {
            $filters = [
                // 'company_id' => $request->company_id,
                'search' => $request->search['value'] ?? null
            ];
            return $this->localityService->getDataTable($filters);
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        $file = $request->file('file');

        // Pass a second argument as required by importExcel, e.g., the current user ID or null if not needed
        $count = $this->localityService->importExcel($file, auth()->user()->id);

        return redirect()->back()->with('success', "$count localities imported successfully.");
    }
}
