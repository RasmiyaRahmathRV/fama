<?php

namespace App\Repositories;

use App\Models\PropertyType;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class PropertyTypeRepository
{
    public function all()
    {
        return PropertyType::all();
    }

    public function find($id)
    {
        return PropertyType::findOrFail($id);
    }

    public function findId($data)
    {
        return PropertyType::where($data)->first();
    }

    public function createOrRestore(array $data)
    {
        // Check existing including soft deleted
        $propertType = PropertyType::withTrashed()
            ->where('company_id', $data['company_id'])
            ->where('property_type', $data['property_type'])
            ->first();

        if ($propertType) {
            if ($propertType->trashed()) {
                $propertType->restore();
                $propertType->update($data); // restore + update values
            }
        } else {
            $propertType = PropertyType::create($data);
        }

        return $propertType;
    }

    public function updateOrRestore($id, array $data)
    {
        $propertyType = PropertyType::withTrashed()->findOrFail($id);

        if ($propertyType->trashed()) {
            $propertyType->restore();
        }

        $propertyType->update($data);

        return $propertyType;
    }

    public function delete($id)
    {
        $property_type = $this->find($id);
        return $property_type->delete();
    }

    public function getQuery(array $filters = []): Builder
    {
        $query = PropertyType::query()
            ->select('property_types.*', 'companies.company_name')
            ->join('companies', 'companies.id', '=', 'property_types.company_id');

        if (!empty($filters['search'])) {
            $query->orwhere('property_type', 'like', '%' . $filters['search'] . '%')
                ->orWhere('property_type_code', 'like', '%' . $filters['search'] . '%')
                ->orWhereHas('companies', function ($q) use ($filters) {
                    $q->where('company_name', 'like', '%' . $filters['search'] . '%');
                })
                ->orWhereRaw("CAST(property_types.id AS CHAR) LIKE ?", ['%' . $filters['search'] . '%']);
        }

        if (!empty($filters['company_id'])) {
            $query->Where('company_id', $filters['company_id']);
        }

        return $query;
    }

    public function insertBulk(array $rows)
    {
        return PropertyType::insert($rows); // bulk insert
    }

    public function getByName($name)
    {
        return PropertyType::wherePropertyType($name)->first();
    }

    public function getByData($propertyData)
    {
        return PropertyType::where($propertyData)->first();
    }

    public function checkIfExist($data)
    {
        $existing = PropertyType::withTrashed()
            ->where('company_id', $data['company_id'])
            ->where('property_type', $data['property_type'])
            ->first();

        if ($existing && $existing->trashed()) {
            // $existing->restore();
            return $existing;
        }
    }
}
