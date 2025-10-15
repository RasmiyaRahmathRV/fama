<?php

namespace App\Services;

use App\Models\Contract;
use App\Repositories\ContractRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ContractService
{
    protected $contractRepository;

    public function __construct(ContractRepository $contactRepository)
    {
        $this->contractRepository = $contactRepository;
    }
    public function getAll()
    {
        return $this->contractRepository->all();
    }

    public function getById($id)
    {
        return $this->contractRepository->find($id);
    }
    public function createOrRestore(array $data, $user_id = null)
    {
        $this->validate($data);
        $data['added_by'] = $user_id ? $user_id : auth()->user()->id;
        $data['project_code'] = $this->setProjectCode();


        $existing = $this->contractRepository->checkIfExist($data);

        if ($existing) {
            if ($existing->trashed()) {
                $existing->restore();
            }
            $existing->fill($data);
            $existing->save();
            return $existing;
        }

        return $this->contractRepository->create($data);
    }
    public function setProjectCode($addval = 1)
    {
        $codeService = new \App\Services\CodeGeneratorService();
        return $codeService->generateNextCode('contracts', 'project_code', 'PRJ', 5, $addval);
    }

    public function update($id, array $data)
    {
        $this->validate($data, $id);
        $data['updated_by'] = auth()->user()->id;
        return $this->contractRepository->update($id, $data);
    }
    private function validate(array $data, $id = null)
    {
        $validator = Validator::make($data, [], []);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public function checkIfExist($data)
    {
        return $this->contractRepository->checkIfExist($data);
    }
    public function delete($id)
    {
        return $this->contractRepository->delete($id);
    }
    public function getDataTable(array $filters = [])
    {
        $query = $this->contractRepository->getQuery($filters);

        $columns = [
            ['data' => 'DT_RowIndex', 'name' => 'id'],
            ['data' => 'project_code', 'name' => 'project_code'],
            ['data' => 'vendor', 'name' => 'vendor'],
            ['data' => 'tenant', 'name' => 'tenant'],
            ['data' => 'building', 'name' => 'building'],
            ['data' => 'start_date', 'name' => 'start_date'],
            ['data' => 'expiry_date', 'name' => 'expiry_date'],
            ['data' => 'status', 'name' => 'status'],
            ['data' => 'action', 'name' => 'action', 'orderable' => true, 'searchable' => true],
        ];

        return datatables()
            ->of($query)
            ->addIndexColumn()
            ->addColumn('project_code', fn($row) => ucfirst($row->project_code) ?? '-')
            ->addColumn('vendor', fn($row) => $row->vendor ?? '-')
            ->addColumn('tenant', fn($row) => $row->tenant ?? '-')
            ->addColumn('building', fn($row) => $row->building ?? '-')
            ->addColumn('start_date', fn($row) => $row->start_date ?? '-')
            ->addColumn('expiry_date', fn($row) => $row->expiry_date ?? '-')
            ->addColumn('status', fn($row) => $row->status ?? '-')

            ->addColumn('action', function ($row) {
                $action = '';
                if (Gate::allows('contract.document_upload')) {
                    $action .= '<a href="{{ route("contract.document_upload") }}" class="btn btn-warning btn-sm"
                                                    title="documents"><i class="fas fa-file"></i></a>';
                }
                if (Gate::allows('contract.view')) {
                    $action .= '<a class="btn btn-primary btn-sm" href="{{ route("contract.show") }}"
                                                    title="view contract"><i class="fas fa-eye"></i></a>';
                }
                if (Gate::allows('contract.edit')) {
                    $action .= '<a class="btn btn-info  btn-sm" data-toggle="modal"
                                                    data-target="#modal-Contract"  data-row=\'' .  json_encode($row)  . '\' title="edit contract"><i
                                                        class="fas fa-pencil-alt"></i></a>';
                }
                if (Gate::allows('contract.delete')) {
                    $action .= '<a class="btn btn-danger  btn-sm" onclick="deleteConf(' . $row->id . ')" title="delete"><i
                                                        class="fas fa-trash"></i></a>';
                }

                return $action ?: '-';
            })
            ->rawColumns(['action'])
            ->with(['columns' => $columns]) // send columns too
            ->toJson();
    }



    // Add more business logic here
}
