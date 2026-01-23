<?php

namespace App\Http\Controllers;

use App\Exports\AreasExport;
use App\Models\Area;
use App\Services\AreaImportService;
use App\Services\AreaService;
use App\Services\CompanyService;
use App\Imports\AreasImport;
use App\Models\ImportBatch;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class AreaController extends Controller
{

    public function __construct(
        protected AreaService $areaService,
        protected CompanyService $companyService,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Area';
        $companies = $this->companyService->getAll();
        return view('admin.master.area', compact('title', 'companies'));
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
    // StoreAreaRequest
    public function store(Request $request)
    {
        try {
            if (!empty($request->id)) {
                $area = $this->areaService->update($request->id, $request->all());
                return response()->json([
                    'success' => true,
                    'data' => $area,
                    'message' => 'Area updated successfully'
                ], 200);
            } else {
                $area = $this->areaService->createOrRestore($request->all());

                return response()->json([
                    'success' => true,
                    'data' => $area,
                    'message' => 'Area created successfully'
                ], 201);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'error'   => $e
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        $this->areaService->delete($area->id);
        return response()->json(['success' => true, 'message' => 'Area soft deleted']);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        $file = $request->file('file');

        // Pass a second argument as required by importExcel, e.g., the current user ID or null if not needed
        $result = $this->areaService->importExcel($file, auth()->user()->id);
        // dd($result);

        // return redirect()->back()->with('success', "$count localities imported successfully.");
        if ($result['inserted'] == 0 && $result['restored'] == 0) {
            return response()->json(['success' => false, 'message' => "No new area to import."]);
        } else {
            return response()->json(['success' => true, 'message' =>  "{$result['inserted']} created, {$result['restored']} restored successfully."]);
        }
    }


    public function getAreas(Request $request)
    {
        if ($request->ajax()) {
            $filters = [
                'company_id' => auth()->user()->company_id,
                'search' => $request->search['value'] ?? null
            ];
            return $this->areaService->getDataTable($filters);
        }
    }

    public function getByCompany($company_id)
    {
        return response()->json($this->areaService->getByCompany($company_id));
    }

    public function export()
    {
        $search = request('search');
        $filters = auth()->user()->company_id ? [
            'company_id' => auth()->user()->company_id,
        ] : null;

        return Excel::download(new AreasExport($search, $filters), 'areas.xlsx');
    }
    public function show(Area $area)
    {
        return view('admin.master.area-view', compact('area'));
    }
}
