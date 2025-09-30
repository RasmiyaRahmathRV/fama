<?php

namespace App\Services;

use App\Imports\BankImport;
use App\Repositories\InstallmentRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class InstallmentService
{

    public function __construct(
        protected InstallmentRepository $installmentRepository,
        protected CompanyService $companyService,
    ) {}

    public function getAll()
    {
        return $this->installmentRepository->all();
    }

    public function getById($id)
    {
        return $this->installmentRepository->find($id);
    }

    public function createOrRestore(array $data, $user_id = null)
    {
        $this->validate($data);
        $data['added_by'] = $user_id ? $user_id : auth()->user()->id;
        $data['installment_code'] = $this->setInstallmentCode();

        $existing = $this->installmentRepository->checkIfExist($data);

        if ($existing) {
            if ($existing->trashed()) {
                $existing->restore();
            }
            $existing->fill($data);
            $existing->save();
            return $existing;
        }

        return $this->installmentRepository->create($data);
    }

    public function update($id, array $data)
    {
        $this->validate($data, $id);
        $data['updated_by'] = auth()->user()->id;
        return $this->installmentRepository->updateOrRestore($id, $data);
    }

    public function delete($id)
    {
        return $this->installmentRepository->delete($id);
    }

    public function setInstallmentCode($addval = 1)
    {
        $codeService = new \App\Services\CodeGeneratorService();
        return $codeService->generateNextCode('installments', 'installment_code', 'INS', 5, $addval);
    }

    private function validate(array $data, $id = null)
    {
        $validator = Validator::make($data, [
            'installment_name' => [
                'required',
                Rule::unique('installments')->ignore($id)
                    ->where(fn($q) => $q->where('company_id', $data['company_id'])
                        ->whereNull('deleted_at'))
            ],
            'company_id' => 'required|exists:companies,id',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public function getDataTable(array $filters = [])
    {
        $query = $this->installmentRepository->getQuery($filters);

        $columns = [
            ['data' => 'DT_RowIndex', 'name' => 'id'],
            ['data' => 'company_name', 'name' => 'company_name'],
            ['data' => 'installment_name', 'name' => 'installment_name'],
            ['data' => 'action', 'name' => 'action', 'orderable' => true, 'searchable' => true],
        ];

        return datatables()
            ->of($query)
            ->addIndexColumn()
            ->addColumn('company_name', fn($row) => $row->company->company_name ?? '-')
            ->addColumn('installment_name', fn($row) => $row->installment_name ?? '-')
            ->addColumn('action', fn($row) => '<button class="btn btn-info" data-toggle="modal"
                                                        data-target="#modal-installment"
                                                        data-row=\'' .  json_encode($row)  . '\'>Edit</button>
                                                        <button class="btn btn-danger" onclick="deleteConf(' . $row->id . ')" type="submit">Delete</button>')
            ->rawColumns(['action'])
            ->with(['columns' => $columns]) // send columns too
            ->toJson();
    }

    public function importExcel($file, $user_id)
    {
        // Read Excel as collection
        $rows = Excel::toCollection(new BankImport, $file)->first();

        $insertData = [];
        foreach ($rows as $key => $row) {
            // dd($row);
            $company_id = $this->companyService->getIdByCompanyname($row['company']);

            if ($company_id == null) {
                $existing = $this->companyService->checkIfExist(array('company_name' => $row['company'], 'installment_name' => $row['installment']));

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

            $bankexist = $this->installmentRepository->checkIfExist(array('installment_name' => $row['installment'], 'company_id' => $company_id));

            if (empty($bankexist)) {
                $insertData[] = [
                    'company_id' => $company_id,
                    'installment_code' => $this->setInstallmentCode($key + 1),
                    'installment_name' => $row['installment'],
                    'created_at' => now(),
                    'updated_at' => now(),
                    'added_by' => $user_id,
                ];
            }
        }

        $this->installmentRepository->insertBulk($insertData);

        return count($insertData);
    }
}
