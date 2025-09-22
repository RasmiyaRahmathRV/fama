<?php

namespace App\Repositories;

use App\Models\Locality;
use Illuminate\Contracts\Database\Eloquent\Builder;

class LocalityRepository
{
    public function all()
    {
        return Locality::all();
    }

    public function find($id)
    {
        return Locality::findOrFail($id);
    }

    public function create(array $data)
    {
        return Locality::create($data);
    }

    public function update($id, array $data)
    {
        $locality = $this->find($id);
        $locality->update($data);
        return $locality;
    }

    public function delete($id)
    {
        $locality = $this->find($id);
        return $locality->delete();
    }

    public function getQuery(array $filters = []): Builder
    {
        $query = Locality::query()
            ->select('localities.*', 'companies.company_name', 'areas.area_name')
            ->join('areas', 'areas.id', '=', 'localities.area_id')
            ->join('companies', 'companies.id', '=', 'localities.company_id');

        if (!empty($filters['search'])) {
            $query->orwhere('locality_name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('locality_code', 'like', '%' . $filters['search'] . '%')
                ->orWhereHas('companies', function ($q) use ($filters) {
                    $q->where('company_name', 'like', '%' . $filters['search'] . '%');
                })
                ->orWhereHas('areas', function ($q) use ($filters) {
                    $q->where('area_name', 'like', '%' . $filters['search'] . '%');
                })
                ->orWhereRaw("CAST(localities.id AS CHAR) LIKE ?", ['%' . $filters['search'] . '%']);
        }

        if (!empty($filters['company_id'])) {
            $query->Where('company_id', $filters['company_id']);
        }

        if (!empty($filters['area_id'])) {
            $query->Where('area_id', $filters['area_id']);
        }

        return $query;
    }

    public function insertBulk(array $rows)
    {
        return Locality::insert($rows); // bulk insert
    }
}
