<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Services\AreaService;
use Illuminate\Http\Request;

class AreaController extends Controller
{

    protected $areaService;

    public function __construct(AreaService $areaService)
    {
        $this->areaService = $areaService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Area';
        $areas = $this->areaService->getAll();
        return view('admin.area', compact('title', 'areas'));
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
            $area = $this->areaService->create($request->all());

            return response()->json([
                'success' => true,
                'data' => $area,
                'message' => 'Area created successfully'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'error'   => $e
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    // UpdateAreaRequest
    public function update(Request $request, Area $area)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        //
    }
}
