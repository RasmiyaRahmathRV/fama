<?php

namespace App\Services;

use App\Repositories\AreaRepository;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

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

    public function getByName($name)
    {
        return $this->areaRepository->getByName($name);
    }

    public function create(array $data, $user_id = null)
    {
        $this->validate($data);
        $data['added_by'] = $user_id ? $user_id : auth()->user()->id;
        $data['area_code'] = $this->setAreaCode();
        return $this->areaRepository->createOrRestore($data);
    }

    public function update($id, array $data)
    {
        $this->validate($data, $id);
        $data['updated_by'] = auth()->user()->id;
        return $this->areaRepository->updateOrRestore($id, $data);
    }

    public function delete($id)
    {
        return $this->areaRepository->delete($id);
    }

    public function setAreaCode($addval = 1)
    {
        $codeService = new \App\Services\CodeGeneratorService();
        return $codeService->generateNextCode('areas', 'area_code', 'ARE', 5, $addval);
    }

    public function getByCompany($company)
    {
        return $this->areaRepository->getByCompany($company);
    }

    private function validate(array $data, $id = null)
    {
        $validator = Validator::make($data, [
            'company_id' => 'required|exists:companies,id',
            'area_name' => [
                'required',
                'string',
                Rule::unique('areas')->ignore($id)
                    ->where(fn($query) => $query->where('company_id', $data['company_id']))
                    ->whereNull('deleted_at'),
            ],
        ], [
            'area_name.unique' => 'This area name already exists. Please choose another.',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public function getDataTable(array $filters = [])
    {
        $query = $this->areaRepository->getQuery($filters);

        $columns = [
            ['data' => 'DT_RowIndex', 'name' => 'id'],
            ['data' => 'area_name', 'name' => 'area_name'],
            ['data' => 'company_name', 'name' => 'company_name'],
            ['data' => 'action', 'name' => 'action', 'orderable' => true, 'searchable' => true],
        ];

        return datatables()
            ->of($query)
            ->addIndexColumn()
            ->addColumn('area_name', fn($row) => $row->area_name ?? '-')
            ->addColumn('company_name', fn($row) => $row->company->company_name ?? '-')
            ->addColumn('action', fn($row) => '<button class="btn btn-info" data-toggle="modal"
                                                        data-target="#modal-area" data-id="' . $row->id . '"
                                                        data-name="' . $row->area_name . '"
                                                        data-company="' . $row->company_id . '">Edit</button>
                                                        <button class="btn btn-danger" onclick="deleteConf(' . $row->id . ')" type="submit">Delete</button>')
            ->rawColumns(['action'])
            ->with(['columns' => $columns]) // send columns too
            ->toJson();
    }

    public function checkIfExist($data)
    {
        return $this->areaRepository->checkIfExist($data);
    }

    // public function exportExcel(array $filters = [])
    // {
    //     return Excel::download(new AreaExport($filters), 'areas.xlsx');
    // }
}
