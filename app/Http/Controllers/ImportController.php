<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AreasImport;
use App\Services\AreaImportService;
use App\Services\AreaService;

class ImportController extends Controller
{

    protected $areaImportservice;

    public function __construct(AreaImportService $areaImportService)
    {
        $this->areaImportservice = $areaImportService;
    }

    public function importAreas(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);
        Excel::queueImport(
            new AreasImport($this->areaImportservice, 0, 0),
            $request->file('file'),
            null // or specify a queue name if needed
        );

        return response()->json([
            'message' => 'Import started. You will be notified once it is completed.'
        ]);

        // Excel::queueImport($this->areasImport, $request->file('file'));
        // Excel::import($this->areasImport, $request->file('file'));
    }
}
