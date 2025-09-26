<?php

namespace App\Services;

use App\Imports\PropertyTypeImport;
use App\Repositories\PropertyTypeRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class PropertyTypeService
{

    public function __construct(
        protected PropertyTypeRepository $propertyTypeRepository,
        protected CompanyService $companyService,
        protected AreaService $areaService,
        protected LocalityService $localityService
    ) {}

    public function getAll()
    {
        return $this->propertyTypeRepository->all();
    }

    public function getById($id)
    {
        return $this->propertyTypeRepository->find($id);
    }

    public function create(array $data, $user_id = null)
    {
        $this->validate($data);
        $data['added_by'] = $user_id ? $user_id : auth()->user()->id;
        $data['property_type_code'] = $this->setPropertyTypeCode();
        return $this->propertyTypeRepository->createOrRestore($data);
    }

    public function update($id, array $data)
    {
        $this->validate($data, $id);
        $data['updated_by'] = auth()->user()->id;
        return $this->propertyTypeRepository->updateOrRestore($id, $data);
    }

    public function delete($id)
    {
        return $this->propertyTypeRepository->delete($id);
    }

    public function setPropertyTypeCode($addval = 1)
    {
        $codeService = new \App\Services\CodeGeneratorService();
        return $codeService->generateNextCode('property_types', 'property_type_code', 'PTY', 5, $addval);
    }

    private function validate(array $data, $id = null, $company_id = null)
    {
        $validator = Validator::make($data, [
            'property_type' => [
                'required',
                Rule::unique('property_types', 'property_type')->ignore($id)
                    ->where(fn($q) => $q->where('company_id', $company_id)),
            ],
            'company_id' => 'required|exists:companies,id',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public function getDataTable(array $filters = [])
    {
        $query = $this->propertyTypeRepository->getQuery($filters);

        $columns = [
            ['data' => 'DT_RowIndex', 'name' => 'id'],
            ['data' => 'company_name', 'name' => 'company_name'],
            ['data' => 'property_type', 'name' => 'property_type'],
            ['data' => 'action', 'name' => 'action', 'orderable' => true, 'searchable' => true],
        ];

        return datatables()
            ->of($query)
            ->addIndexColumn()
            ->addColumn('company_name', fn($row) => $row->company->company_name ?? '-')
            ->addColumn('property_type', fn($row) => $row->property_type ?? '-')
            ->addColumn('action', fn($row) => '<button class="btn btn-info" data-toggle="modal"
                                                        data-target="#modal-property-type" data-id="' . $row->id . '"
                                                        data-name="' . $row->property_type . '"
                                                        data-company="' . $row->company_id . '">Edit</button>
                                                        <button class="btn btn-danger" onclick="deleteConf(' . $row->id . ')" type="submit">Delete</button>')
            ->rawColumns(['action'])
            ->with(['columns' => $columns]) // send columns too
            ->toJson();
    }

    public function importExcel($file, $user_id)
    {
        // Read Excel as collection
        $rows = Excel::toCollection(new PropertyTypeImport, $file)->first();

        $insertData = [];
        foreach ($rows as $key => $row) {
            // dd($row);
            $company_id = $this->companyService->getIdByCompanyname($row['company']);

            if ($company_id == null) {
                $existing = $this->companyService->checkIfExist(array('company_name' => $row['company']));


                if (!empty($existing)) {
                    // echo "exist";
                    $existing->restore();

                    $company_id = $existing->id;
                } else {
                    $company_id = $this->companyService->create([
                        'company_name' => $row['company'],
                    ], $user_id)->id;
                }
            }

            $insertData[] = [
                'company_id' => $company_id,
                'property_type_code' => $this->setPropertyTypeCode($key + 1),
                'property_type' => $row['property_type'],
                'created_at' => now(),
                'updated_at' => now(),
                'added_by' => $user_id,
            ];
        }

        $this->propertyTypeRepository->insertBulk($insertData);

        return count($insertData);
    }

    public function getByName($name)
    {
        return $this->propertyTypeRepository->getByName($name);
    }

    public function getByData($propertData)
    {
        return $this->propertyTypeRepository->getByData($propertData);
    }

    public function checkIfExist($data)
    {
        return $this->propertyTypeRepository->checkIfExist($data);
    }
}
