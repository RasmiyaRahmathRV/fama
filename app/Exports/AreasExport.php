<?php

namespace App\Exports;

use App\Models\Area;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AreasExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function __construct(
        protected $search = null,
        protected $filter = null,
    ) {}

    public function collection()
    {
        // $query = Area::with('company');
        $query = Area::query();

        if ($this->search) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->where('area_name', 'like', "%{$search}%")
                    ->orWhere('area_code', 'like', "%{$search}%")
                    // ->orWhereHas('company', function ($q2) use ($search) {
                    //     $q2->where('company_name', 'like', "%{$search}%");
                    // })
                    ->orWhereRaw("CAST(areas.id AS CHAR) LIKE ?", ["%{$search}%"]);
            });
        }

        if ($this->filter) {
            $query->where('company_id', $this->filter);
        }

        return $query->get()
            ->map(function ($area) {
                return [
                    'ID' => $area->id,
                    'Area Code' => $area->area_code,
                    // 'Company' => $area->company->company_name ?? '',
                    'Area Name' => $area->area_name,

                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Area Code',
            //   'Company',
            'Area Name'
        ];
    }
}
