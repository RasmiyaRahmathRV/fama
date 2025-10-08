<?php

namespace App\Repositories;

use App\Models\Area;
use Illuminate\Contracts\Database\Eloquent\Builder;

class AreaRepository
{
    public function all()
    {
        return Area::all();
    }

    public function find($id)
    {
        return Area::findOrFail($id);
    }

    public function getByName($areaData)
    {
        return Area::where($areaData)->first();
    }

    public function create($data)
    {
        return Area::create($data);
    }

    public function updateOrRestore(int $id, array $data)
    {
        $area = Area::withTrashed()->findOrFail($id);

        if ($area->trashed()) {
            $area->restore();
        }

        $area->update($data);

        return $area;
    }

    public function delete($id)
    {
        $area = $this->find($id);
        return $area->delete();
    }

    public function uniqAreaName($area_name, $company_id)
    {
        return Area::where('area_name', $area_name)
            ->where('company_id', $company_id)
            ->first();
    }

    public function getByCompany($company_id)
    {
        return Area::where('company_id', $company_id)->get();
    }

    public function getQuery(array $filters = []): Builder
    {
        $query = Area::query()
            ->select('areas.*', 'companies.company_name')
            ->join('companies', 'companies.id', '=', 'areas.company_id');

        if (!empty($filters['search'])) {
            $query->orwhere('area_name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('area_code', 'like', '%' . $filters['search'] . '%')
                ->orWhereHas('company', function ($q) use ($filters) {
                    $q->where('company_name', 'like', '%' . $filters['search'] . '%');
                })
                ->orWhereRaw("CAST(areas.id AS CHAR) LIKE ?", ['%' . $filters['search'] . '%']);
        }

        if (!empty($filters['company_id'])) {
            $query->Where('company_id', $filters['company_id']);
        }

        return $query;
    }

    public function checkIfExist($data)
    {
        $existing = Area::withTrashed()
            ->where('company_id', $data['company_id'])
            ->where('area_name', $data['area_name'])
            ->first();

        if ($existing && $existing->trashed()) {
            // $existing->restore();
            return $existing;
        }
    }

    public function insertBulk(array $rows)
    {
        return Area::insert($rows); // bulk insert
    }
}
