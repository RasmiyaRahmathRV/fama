<?php

namespace App\Repositories;

use App\Models\Area;

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

    public function create(array $data)
    {
        return Area::create($data);
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
}
