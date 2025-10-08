<?php

namespace App\Repositories;

use App\Models\Property;
use Illuminate\Contracts\Database\Eloquent\Builder;

class PropertyRepository
{
    public function all()
    {
        return Property::all();
    }

    public function find($id)
    {
        return Property::findOrFail($id);
    }

    public function getByName($name)
    {
        return Property::whereAreaName($name)->first();
    }

    public function create(array $data)
    {
        return Property::create($data);
    }

    public function update($id, array $data)
    {
        $area = $this->find($id);
        $area->update($data);
        return $area;
    }

    public function delete($id)
    {
        $area = $this->find($id);
        return $area->delete();
    }

    public function getQuery(array $filters = []): Builder
    {
        $query = Property::query()
            ->select('properties.*', 'companies.company_name', 'areas.area_name', 'localities.locality_name', 'property_types.property_type', 'property_size_units.id as unit_id', 'property_size_units.unit_name as unit_name')
            ->join('companies', 'companies.id', '=', 'properties.company_id')
            ->join('areas', 'areas.id', '=', 'properties.area_id')
            ->join('localities', 'localities.id', '=', 'properties.locality_id')
            ->join('property_types', 'property_types.id', '=', 'properties.property_type_id')
            ->leftJoin('property_size_units', function ($join) {
                $join->on('property_size_units.id', '=', 'properties.property_size_unit')
                    ->whereNotNull('properties.property_size_unit');
            });

        if (!empty($filters['search'])) {
            $query->orwhere('property_name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('property_code', 'like', '%' . $filters['search'] . '%')
                ->orWhere('property_size', 'like', '%' . $filters['search'] . '%')
                ->orWhere('plot_no', 'like', '%' . $filters['search'] . '%')
                ->orWhereHas('company', function ($q) use ($filters) {
                    $q->where('company_name', 'like', '%' . $filters['search'] . '%');
                })
                ->orWhereHas('area', function ($q) use ($filters) {
                    $q->where('area_name', 'like', '%' . $filters['search'] . '%');
                })
                ->orWhereHas('locality', function ($q) use ($filters) {
                    $q->where('locality_name', 'like', '%' . $filters['search'] . '%');
                })
                ->orWhereHas('propertyType', function ($q) use ($filters) {
                    $q->where('property_type', 'like', '%' . $filters['search'] . '%');
                })
                ->orWhereRaw("CAST(properties.id AS CHAR) LIKE ?", ['%' . $filters['search'] . '%']);
        }

        if (!empty($filters['company_id'])) {
            $query->Where('properties.company_id', $filters['company_id']);
        }

        return $query;
    }

    public function insertBulk(array $rows)
    {
        return Property::insert($rows); // bulk insert
    }

    public function checkIfExist($data)
    {
        $existing = Property::withTrashed()
            ->where('company_id', $data['company_id'])
            ->where('area_id', $data['area_id'])
            ->where('locality_id', $data['locality_id'])
            ->where('property_name', $data['property_name'])
            ->first();

        if ($existing && $existing->trashed()) {
            // $existing->restore();
            return $existing;
        }
    }
}
