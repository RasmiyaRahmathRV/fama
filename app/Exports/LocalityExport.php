<?php

namespace App\Exports;

use App\Models\Locality;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LocalityExport implements FromCollection, WithHeadings
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
        // $query = Locality::with('area.company');
        $query = Locality::with('area');


        if ($this->search) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->where('locality_name', 'like', "%{$search}%")
                    ->orWhere('locality_code', 'like', "%{$search}%")
                    // ->orWhereHas('company', function ($q2) use ($search) {
                    //     $q2->where('company_name', 'like', "%{$search}%");
                    // })
                    ->orWhereHas('area', function ($q2) use ($search) {
                        $q2->where('area_name', 'like', "%{$search}%");
                    })
                    ->orWhereRaw("CAST(localities.id AS CHAR) LIKE ?", ["%{$search}%"]);
            });
        }

        // if ($this->filter) {
        //     $query->where('company_id', $this->filter);
        // }


        return $query->get()
            ->map(function ($locality) {
                return [
                    'ID' => $locality->id,
                    'Locality Code' => $locality->locality_code,
                    // 'Company' => $locality->company->company_name ?? '',
                    'Area' => $locality->area->area_name ?? '',
                    'Locality Name' => $locality->locality_name,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Locality Code',
            // 'Company',
            'Area',
            'Locality Name'
        ];
    }
}
