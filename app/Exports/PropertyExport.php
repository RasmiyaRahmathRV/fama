<?php

namespace App\Exports;

use App\Models\Property;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PropertyExport implements FromCollection, WithHeadings
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
        $query = Property::with([
            'locality.area.company',
            'propertyType.company'
        ]);

        if ($this->search) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->where('property_name', 'like', "%{$search}%")
                    ->orWhere('property_code', 'like', "%{$search}%")
                    ->orWhere('property_size', 'like', "%{$search}%")
                    ->orWhere('property_size_unit', 'like', "%{$search}%")
                    ->orWhere('plot_no', 'like', "%{$search}%")
                    ->orWhereHas('company', function ($q2) use ($search) {
                        $q2->where('company_name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('area', function ($q) use ($search) {
                        $q->where('area_name', 'like', '%' . $search['search'] . '%');
                    })
                    ->orWhereHas('locality', function ($q) use ($search) {
                        $q->where('locality_name', 'like', '%' . $search['search'] . '%');
                    })
                    ->orWhereHas('propertyType', function ($q) use ($search) {
                        $q->where('property_type', 'like', '%' . $search['search'] . '%');
                    })
                    ->orWhereRaw("CAST(property_types.id AS CHAR) LIKE ?", ["%{$search}%"]);
            });
        }

        if ($this->filter) {
            $query->where('company_id', $this->filter);
        }


        return $query->get()
            ->map(function ($property) {
                return [
                    'ID' => $property->id,
                    'Property Code' => $property->property_code,
                    'Company' => $property->company->company_name ?? '',
                    'area' => $property->area->area_name ?? '',
                    'locality' => $property->locality->locality_name ?? '',
                    'Property Type' => $property->propertyType->property_type,
                    'Property Name' => $property->property_name,
                    'Property Size' => $property->property_size_unit . ' ' . $property->property_size,
                    'Plot No' => $property->plot_no,

                ];
            });
    }

    public function headings(): array
    {
        return ['ID', 'Property Code', 'Company', 'Area', 'Locality', 'Property Type', 'Property name', 'Property Size', 'Plot No'];
    }
}
