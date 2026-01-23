<?php

namespace App\Http\Controllers;

use App\Exports\PropertyExport;
use App\Models\Property;
use App\Models\PropertySizeUnit;
use App\Services\AreaService;
use App\Services\CompanyService;
use App\Services\LocalityService;
use App\Services\PropertyService;
use App\Services\PropertyTypeService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class PropertyController extends Controller
{

    public function __construct(
        protected PropertyService $propertyService,
        protected CompanyService $companyService,
        protected LocalityService $localityService,
        protected AreaService $areaService,
        protected PropertyTypeService $propertyTypeService
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Property Type';
        $companies = $this->companyService->getAll();
        $localities = $this->localityService->getAll();
        $areas = $this->areaService->getAll();
        $property_types = $this->propertyTypeService->getAll();
        $propertySizeUnits = PropertySizeUnit::all();

        return view("admin.master.property", compact("companies", "localities", "areas", "property_types", "propertySizeUnits"));
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
        // dd($request);
        try {
            if (!empty($request->id)) {
                $property = $this->propertyService->update($request->id, $request->all());
                return response()->json([
                    'success' => true,
                    'data' => $property,
                    'message' => 'Property  updated successfully'
                ], 200);
            } else {
                $property = $this->propertyService->createOrRestore($request->all());

                return response()->json([
                    'success' => true,
                    'data' => $property,
                    'message' => 'Property  created successfully'
                ], 201);
            }
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) { // integrity constraint violation
                throw ValidationException::withMessages([
                    'property' => 'Property already exists for this locality under this company.',
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
    public function show(Property $property)
    {
        //
        return view("admin.master.property-view", compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $this->propertyService->delete($property->id);
        return response()->json(['success' => true, 'message' => 'Property soft deleted']);
    }

    public function getProperties(Request $request)
    {
        if ($request->ajax()) {
            $filters = [
                'company_id' => auth()->user()->company_id,
                'search' => $request->search['value'] ?? null
            ];

            return $this->propertyService->getDataTable($filters);
        }
    }

    public function exportProperty(Request $request)
    {
        $search = request('search');
        $filters = auth()->user()->company_id ? [
            'company_id' => auth()->user()->company_id,
        ] : null;


        return Excel::download(new PropertyExport($search, $filters), 'property.xlsx');
    }

    public function importProperty(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        $file = $request->file('file');

        // Pass a second argument as required by importExcel, e.g., the current user ID or null if not needed
        $result = $this->propertyService->importExcel($file, auth()->user()->id);

        // return redirect()->back()->with('success', "$count property imported successfully.");
        if ($result['inserted'] == 0 && $result['restored'] == 0) {
            return response()->json(['success' => false, 'message' => "No new property to import."]);
        } else {
            return response()->json(['success' => true, 'message' => "{$result['inserted']} created, {$result['restored']} restored successfully."]);
        }
    }
}
