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

    protected $areaService;
    protected $companyService;
    protected $areaImportService;

    public function __construct(AreaService $areaService, CompanyService $companyService, AreaImportService $areaImportService)
    {
        $this->areaService = $areaService;
        $this->companyService = $companyService;
        $this->areaImportService = $areaImportService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Area';
        $companies = $this->companyService->getAll();
        return view('admin.area', compact('title', 'companies'));
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
            'file' => 'required|mimes:xlsx,csv',
        ]);

        $user_id = auth()->user()->id;
        $file = $request->file('file');

        // Create batch record
        $batch = ImportBatch::create([
            'file_name' => $file->getClientOriginalName(),
            'total_rows' => null, // optional: can be counted from file if needed
            'processed_rows' => 0,
            'status' => 'pending',
            'added_by' => $user_id,
        ]);

        Excel::queueImport(new AreasImport($this->areaImportService, $user_id, $batch->id), $file);

        return response()->json([
            'message' => 'Import started. You can track progress in import batches.',
            'batch_id' => $batch->id
        ]);
    }

    public function batchProgress($batch_id)
    {
        $batch = ImportBatch::findOrFail($batch_id);

        return response()->json([
            'status' => $batch->status,
            'processed_rows' => $batch->processed_rows,
            'total_rows' => $batch->total_rows,
        ]);
    }

    public function getAreas(Request $request)
    {
        if ($request->ajax()) {
            $filters = [
                // 'company_id' => $request->company_id,
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

        return Excel::download(new AreasExport($search), 'areas.xlsx');
    }
}
