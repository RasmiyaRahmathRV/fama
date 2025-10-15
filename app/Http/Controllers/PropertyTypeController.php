<?php

namespace App\Http\Controllers;

use App\Exports\PropertyTypeExport;
use App\Models\PropertyType;
use App\Services\CompanyService;
use App\Services\PropertyTypeService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class PropertyTypeController extends Controller
{

    protected $propertyTypeService;
    protected $companyService;

    public function __construct(PropertyTypeService $propertyTypeService, CompanyService $companyService)
    {
        $this->propertyTypeService = $propertyTypeService;
        $this->companyService = $companyService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Property Type';
        $companies = $this->companyService->getAll();
        return view("admin.master.property_type", compact("companies"));
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
            if (!empty($request->id)) {
                $property_type = $this->propertyTypeService->update($request->id, $request->all());
                return response()->json([
                    'success' => true,
                    'data' => $property_type,
                    'message' => 'Property Type updated successfully'
                ], 200);
            } else {
                $property_type = $this->propertyTypeService->createOrRestore($request->all());

                return response()->json([
                    'success' => true,
                    'data' => $property_type,
                    'message' => 'Property Type created successfully'
                ], 201);
            }
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) { // integrity constraint violation
                throw ValidationException::withMessages([
                    'property_type' => 'This property type already exists for this company.',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                    'error'   => $e
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PropertyType $propertyType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PropertyType $propertyType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PropertyType $propertyType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PropertyType $propertyType)
    {
        $this->propertyTypeService->delete($propertyType->id);
        return response()->json(['success' => true, 'message' => 'Property type soft deleted']);
    }

    public function getPropertyType(Request $request)
    {
        if ($request->ajax()) {
            $filters = [
                'company_id' => auth()->user()->company_id,
                'search' => $request->search['value'] ?? null
            ];
            return $this->propertyTypeService->getDataTable($filters);
        }
    }

    public function importPropertyType(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        $file = $request->file('file');

        // Pass a second argument as required by importExcel, e.g., the current user ID or null if not needed
        $count = $this->propertyTypeService->importExcel($file, auth()->user()->id);

        return redirect()->back()->with('success', "$count property types imported successfully.");
    }

    public function exportPropertyType(Request $request)
    {
        $search = request('search');
        $filters = auth()->user()->company_id ? [
            'company_id' => auth()->user()->company_id,
        ] : null;

        return Excel::download(new PropertyTypeExport($search, $filters), 'property_type.xlsx');
    }
}
