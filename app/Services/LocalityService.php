<?php

namespace App\Services;

use App\Imports\LocalityImport;
use App\Repositories\LocalityRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class LocalityService
{
    protected $localityRepository;
    protected $companyService;
    protected $areaService;


    public function __construct(LocalityRepository $localityRepository, CompanyService $companyService, AreaService $areaService)
    {
        $this->localityRepository = $localityRepository;
        $this->companyService = $companyService;
        $this->areaService = $areaService;
    }

    public function getAll()
    {
        return $this->localityRepository->all();
    }

    public function getById($id)
    {
        return $this->localityRepository->find($id);
    }

    public function create(array $data)
    {
        $this->validate($data);
        $data['added_by'] = auth()->user()->id;
        $data['locality_code'] = $this->setLocalityCode();
        return $this->localityRepository->createOrRestore($data);
    }

    public function update($id, array $data)
    {
        $this->validate($data, $id);
        $data['updated_by'] = auth()->user()->id;
        return $this->localityRepository->updateOrRestore($id, $data);
    }

    public function delete($id)
    {
        return $this->localityRepository->delete($id);
    }

    public function getByData($name)
    {
        return $this->localityRepository->getByData($name);
    }

    public function setLocalityCode($addval = 1)
    {
        $codeService = new \App\Services\CodeGeneratorService();
        return $codeService->generateNextCode('localities', 'locality_code', 'LOC', 5, $addval);
    }

    private function validate(array $data, $id = null)
    {
        $validator = Validator::make($data, [
            'company_id' => 'required|exists:companies,id',
            'area_id' => 'required|exists:areas,id',
            'locality_name' => [
                'required',
                'string',
                Rule::unique('localities')
                    ->ignore($id)
                    ->where(
                        fn($query) =>
                        $query->where('area_id', $request->area_id ?? null)
                            ->where('company_id', $request->company_id ?? null)
                            ->whereNull('deleted_at'),
                    )
            ],
        ], [
            'locality_name.unique' => 'This locality name already exists. Please choose another.',
            'area_id.unique' => 'This area already exists. Please choose another.',
            'company_id.unique' => 'This company already exists. Please choose another.',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public function getDataTable(array $filters = [])
    {
        $query = $this->localityRepository->getQuery($filters);

        $columns = [
            ['data' => 'DT_RowIndex', 'name' => 'id'],
            ['data' => 'locality_name', 'name' => 'locality_name'],
            ['data' => 'area_name', 'name' => 'area_name'],
            ['data' => 'company_name', 'name' => 'company_name'],
            ['data' => 'action', 'name' => 'action', 'orderable' => true, 'searchable' => true],
        ];

        return datatables()
            ->of($query)
            ->addIndexColumn()
            ->addColumn('locality_name', fn($row) => $row->locality_name ?? '-')
            ->addColumn('area_name', fn($row) => $row->area->area_name ?? '-')
            ->addColumn('company_name', fn($row) => $row->company->company_name ?? '-')
            ->addColumn('action', fn($row) => '<button class="btn btn-info" data-toggle="modal"
                                                        data-target="#modal-locality" data-id="' . $row->id . '"
                                                        data-name="' . $row->locality_name . '"
                                                        data-company="' . $row->company_id . '" data-area="' . $row->area_id . '">Edit</button>
                                                        <button class="btn btn-danger" onclick="deleteConf(' . $row->id . ')" type="submit">Delete</button>')
            ->rawColumns(['action'])
            ->with(['columns' => $columns]) // send columns too
            ->toJson();
    }


    public function importExcel($file, $user_id)
    {
        // Read Excel as collection
        $rows = Excel::toCollection(new LocalityImport, $file)->first();

        $insertData = [];
        foreach ($rows as $key => $row) {
            // dd($row);
            $area = $this->areaService->getByName($row['area']);
            $company_id = $this->companyService->getIdByCompanyname($row['company']);

            if (empty($area)) {
                $existing = $this->areaService->checkIfExist(array('company_id' => $company_id, 'area_name' => $row['area']));

                if (!empty($existing)) {
                    // echo "exist";
                    $existing->restore();

                    $area = $existing;
                } else {
                    $area = $this->areaService->create([
                        'company_id' => $company_id,
                        'area_name' => $row['area'],
                    ], $user_id);
                }
            }

            $insertData[] = [
                'company_id' => $area->company_id,
                'area_id' => $area->id,
                'locality_code' => $this->setLocalityCode($key + 1),
                'locality_name' => $row['locality'],
                'created_at' => now(),
                'updated_at' => now(),
                'added_by' => $user_id,
            ];
        }

        $this->localityRepository->insertBulk($insertData);

        return count($insertData);
    }

    public function checkIfExist($data)
    {
        return $this->localityRepository->checkIfExist($data);
    }
}
