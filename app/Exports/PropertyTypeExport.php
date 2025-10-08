<?php

namespace App\Exports;

use App\Models\PropertyType;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PropertyTypeExport implements FromCollection, WithHeadings
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
        $query = PropertyType::with('company');

        if ($this->search) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->where('property_type', 'like', "%{$search}%")
                    ->orWhere('property_type_code', 'like', "%{$search}%")
                    ->orWhereHas('company', function ($q2) use ($search) {
                        $q2->where('company_name', 'like', "%{$search}%");
                    })
                    ->orWhereRaw("CAST(property_types.id AS CHAR) LIKE ?", ["%{$search}%"]);
            });
        }

        if ($this->filter) {
            $query->where('company_id', $this->filter);
        }

        return $query->get()
            ->map(function ($propertyType) {
                return [
                    'ID' => $propertyType->id,
                    'Property Type Code' => $propertyType->property_type_code,
                    'Company' => $propertyType->company->company_name ?? '',
                    'Property Type' => $propertyType->property_type,

                ];
            });
    }

    public function headings(): array
    {
        return ['ID', 'Property Type Code', 'Company', 'Property Type'];
    }
}
