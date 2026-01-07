<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ArrayToSheetExport implements FromArray, ShouldAutoSize
{
    protected $sheetData;

    public function __construct(array $sheetData)
    {
        $this->sheetData = $sheetData;
    }

    public function array(): array
    {
        return $this->sheetData;
    }
}
