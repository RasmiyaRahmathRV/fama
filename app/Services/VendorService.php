<?php

namespace App\Services;

use App\Imports\VendorImport;
use App\Repositories\VendorRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class VendorService
{

    public function __construct(
        protected VendorRepository $vendorRepository,
        protected CompanyService $companyService,
    ) {}

    public function getAll()
    {
        return $this->vendorRepository->all();
    }

    public function getById($id)
    {
        return $this->vendorRepository->find($id);
    }

    public function createOrRestore(array $data, $user_id = null)
    {
        $this->validate($data);
        $data['added_by'] = $user_id ? $user_id : auth()->user()->id;
        $data['vendor_code'] = $this->setVendorCode();

        $existing = $this->vendorRepository->checkIfExist($data);

        if ($existing) {
            if ($existing->trashed()) {
                $existing->restore();
            }
            $existing->fill($data);
            $existing->save();
            return $existing;
        }

        return $this->vendorRepository->create($data);
    }

    public function update($id, array $data)
    {
        $this->validate($data, $id);
        $data['updated_by'] = auth()->user()->id;
        return $this->vendorRepository->updateOrRestore($id, $data);
    }

    public function delete($id)
    {
        return $this->vendorRepository->delete($id);
    }

    public function setVendorCode($addval = 1)
    {
        $codeService = new \App\Services\CodeGeneratorService();
        return $codeService->generateNextCode('vendors', 'vendor_code', 'VND', 5, $addval);
    }

    private function validate(array $data, $id = null)
    {
        $validator = Validator::make($data, [
            'vendor_name' => [
                'required',
                Rule::unique('vendors')->ignore($id)
                    ->where(fn($q) => $q->where('company_id', $data['company_id'])
                        ->whereNull('deleted_at'))
            ],
            'company_id' => 'required|exists:companies,id',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public function checkIfExist($data)
    {
        return $this->vendorRepository->checkIfExist($data);
    }

    public function getDataTable(array $filters = [])
    {
        $query = $this->vendorRepository->getQuery($filters);

        $columns = [
            ['data' => 'DT_RowIndex', 'name' => 'id'],
            ['data' => 'company_name', 'name' => 'company_name'],
            ['data' => 'vendor_name', 'name' => 'vendor_name'],
            ['data' => 'vendor_phone', 'name' => 'vendor_phone'],
            ['data' => 'vendor_email', 'name' => 'vendor_email'],
            ['data' => 'contact_person', 'name' => 'contact_person'],
            ['data' => 'contact_person_phone', 'name' => 'contact_person_phone'],
            ['data' => 'accountant_name', 'name' => 'accountant_name'],
            ['data' => 'action', 'name' => 'action', 'orderable' => true, 'searchable' => true],
        ];

        return datatables()
            ->of($query)
            ->addIndexColumn()
            ->addColumn('company_name', fn($row) => $row->company->company_name ?? '-')
            ->addColumn('vendor_name', fn($row) => $row->vendor_name ?? '-')
            ->addColumn('vendor_phone', fn($row) => $row->vendor_phone ?? '-')
            ->addColumn('vendor_email', fn($row) => $row->vendor_email ?? '-')
            ->addColumn('contact_person', fn($row) => $row->contact_person ?? '-')
            ->addColumn('contact_person_phone', fn($row) => $row->contact_person_phone ?? '-')
            ->addColumn('accountant_name', fn($row) => $row->accountant_name ?? '-')
            ->addColumn('action', fn($row) => '<button class="btn btn-info" data-toggle="modal"
                                                        data-target="#modal-vendor"
                                                        data-row=\'' .  json_encode($row)  . '\'>Edit</button>
                                                        <button class="btn btn-danger" onclick="deleteConf(' . $row->id . ')" type="submit">Delete</button>')
            ->rawColumns(['action'])
            ->with(['columns' => $columns]) // send columns too
            ->toJson();
    }

    public function importExcel($file, $user_id)
    {
        // Read Excel as collection
        $rows = Excel::toCollection(new VendorImport, $file)->first();

        $insertData = [];
        foreach ($rows as $key => $row) {

            // dd($row);
            $company_id = $this->companyService->getIdByCompanyname($row['company']);

            if ($company_id == null) {
                $existing = $this->companyService->checkIfExist(array('company_id' => $row['company'], 'vendor_name' => $row['vendor_name']));

                if (!empty($existing)) {
                    // echo "exist";
                    $existing->restore();

                    $company_id = $existing->id;
                } else {
                    $company_id = $this->companyService->createOrRestore([
                        'company_name' => $row['company'],
                    ], $user_id)->id;
                }
            }

            $vendorexist = $this->vendorRepository->checkIfExist(array('vendor_name' => $row['vendor_name']));

            if (empty($vendorexist)) {
                $insertData[] = [
                    'company_id' => $company_id,
                    'vendor_code' => $this->setVendorCode($key + 1),
                    'vendor_name' => $row['vendor_name'],
                    'vendor_phone' => $row['vendor_phone'],
                    'vendor_email' => $row['vendor_email'],
                    'vendor_address' => $row['vendor_address'],
                    'contact_person' => $row['vendor_contact_person'],
                    'contact_person_phone' => $row['vendor_contact_number'],
                    'contact_person_email' => $row['vendor_contact_email'],
                    'accountant_name' => $row['vendor_accountant_name'],
                    'accountant_phone' => $row['vendor_accountant_number'],
                    'accountant_email' => $row['vendor_accountant_email'],
                    'created_at' => now(),
                    'updated_at' => now(),
                    'added_by' => $user_id,
                ];
            }
        }

        $this->vendorRepository->insertBulk($insertData);

        return count($insertData);
    }
}
