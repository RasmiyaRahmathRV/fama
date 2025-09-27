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

    public function create($data)
    {

        return Locality::create($data);
    }

    public function updateOrRestore(int $id, array $data)
    {
        $locality = Locality::withTrashed()->findOrFail($id);

        if ($locality->trashed()) {
            $locality->restore();
        }

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

    public function getByData($name)
    {
        return Locality::where($name)->first();
    }

    public function checkIfExist($data)
    {
        $existing = Locality::withTrashed()
            ->where('company_id', $data['company_id'])
            ->where('area_id', $data['area_id'])
            ->where('locality_name', $data['locality_name'])
            ->first();

        if ($existing && $existing->trashed()) {
            // $existing->restore();
            return $existing;
        }
    }
}
