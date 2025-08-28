<?php

namespace App\Services;

use App\Repositories\AreaRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AreaService
{
    protected $areaRepository;

    public function __construct(AreaRepository $areaRepository)
    {
        $this->areaRepository = $areaRepository;
    }

    public function getAll()
    {
        return $this->areaRepository->all();
    }

    public function getById($id)
    {
        return $this->areaRepository->find($id);
    }

    public function create(array $data)
    {
        $this->validate($data);
        $data['added_by'] = auth()->user()->id;
        $data['added_date'] = date('d-m-y H:i:s');
        return $this->areaRepository->create($data);
    }

    public function update($id, array $data)
    {
        $this->validate($data);
        return $this->areaRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->areaRepository->delete($id);
    }

    private function validate(array $data)
    {
        $validator = Validator::make($data, [
            'area_name' => 'required|unique:areas,area_name',
        ], [
            'area_name.unique' => 'This area name already exists. Please choose another.',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
