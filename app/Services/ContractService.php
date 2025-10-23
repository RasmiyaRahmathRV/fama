<?php

namespace App\Services;

use App\Models\Contract;
use App\Repositories\Contracts\ContractRepository;
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


        // $existing = $this->contractRepository->checkIfExist($data);

        // if ($existing) {
        //     if ($existing->trashed()) {
        //         $existing->restore();
        //     }
        //     $existing->fill($data);
        //     $existing->save();
        //     return $existing;
        // }

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

    // public function checkIfExist($data)
    // {
    //     return $this->contractRepository->checkIfExist($data);
    // }

    public function delete($id)
    {
        return $this->contractRepository->delete($id);
    }

    public function getDataTable(array $filters = [])
    {
        $query = $this->contractRepository->getQuery($filters);
        // dd($query);

        $columns = [
            ['data' => 'DT_RowIndex', 'name' => 'id'],
            ['data' => 'project_code', 'name' => 'project_code'],
            ['data' => 'company_name', 'name' => 'company_name'],
            ['data' => 'vendor_name', 'name' => 'vendor_name'],
            ['data' => 'property_name', 'name' => 'property_name'],
            ['data' => 'start_date', 'name' => 'start_date'],
            ['data' => 'end_date', 'name' => 'end_date'],
            ['data' => 'contract_status', 'name' => 'contract_status'],
            ['data' => 'action', 'name' => 'action', 'orderable' => true, 'searchable' => true],
        ];

        return datatables()
            ->of($query)
            ->addIndexColumn()
            ->addColumn('project_code', fn($row) => ucfirst($row->project_code) ?? '-')
            ->addColumn('company_name', fn($row) => $row->company->company_name ?? '-')

            ->addColumn('vendor_name', fn($row) => $row->vendor->vendor_name ?? '-')
            ->addColumn('property_name', fn($row) => $row->property->property_name ?? '-')
            ->addColumn('start_date', fn($row) => $row->contract_detail->start_date ?? '-')
            ->addColumn('end_date', fn($row) => $row->contract_detail->end_date ?? '-')
            ->addColumn('status', fn($row) => $row->contract_status ?? '-')

            ->addColumn('action', function ($row) {
                $action = '';

                if ($row->contract_status == 0) {

                    if (Gate::allows('contract.view')) {
                        $action .= '<a class="btn btn-primary btn-sm" href="' . route('contract.show', $row->id) . '" title="View Contract">
                            <i class="fas fa-eye"></i>
                        </a> ';
                    }

                    if (Gate::allows('contract.edit')) {
                        $action .= '<a class="btn btn-info btn-sm" href="' . route('contract.edit', $row->id) . '" title="Edit Contract">
                            <i class="fas fa-pencil-alt"></i>
                        </a> ';
                    }

                    if (Gate::allows('contract.delete')) {
                        $action .= '<button class="btn btn-danger btn-sm" onclick="deleteConf(' . $row->id . ')" title="Delete Contract">
                            <i class="fas fa-trash"></i>
                        </button>';
                    }
                } elseif ($row->contract_status == 1) {

                    if (Gate::allows('contract.document_upload')) {
                        $action .= '<a href="' . route('contract.documents', $row->id) . '" class="btn btn-warning btn-sm" title="Upload Documents">
                            <i class="fas fa-file"></i>
                        </a> ';
                    }

                    if (Gate::allows('contract.view')) {
                        $action .= '<a class="btn btn-primary btn-sm" href="' . route('contract.show', $row->id) . '" title="View Contract">
                            <i class="fas fa-eye"></i>
                        </a> ';
                    }

                    if (Gate::allows('contract.approve')) {
                        $action .= '<a class="btn btn-info btn-sm" href="' . route('contract.approve', $row->id) . '" title="Approve Contract">
                            <i class="fas fa-thumbs-up"></i>
                        </a>';
                    }
                } elseif ($row->contract_status == 2) {

                    if (Gate::allows('contract.document_upload')) {
                        $action .= '<a href="' . route('contract.documents', $row->id) . '" class="btn btn-warning btn-sm" title="Upload Documents">
                            <i class="fas fa-file"></i>
                        </a> ';
                    }

                    if (Gate::allows('contract.view')) {
                        $action .= '<a class="btn btn-primary btn-sm" href="' . route('contract.show', $row->id) . '" title="View Contract">
                            <i class="fas fa-eye"></i>
                        </a>';
                    }
                } elseif ($row->contract_status == 3) {

                    if (Gate::allows('contract.document_upload')) {
                        $action .= '<a href="' . route('contract.documents', $row->id) . '" class="btn btn-warning btn-sm" title="Upload Documents">
                            <i class="fas fa-file"></i>
                        </a> ';
                    }

                    if (Gate::allows('contract.view')) {
                        $action .= '<a class="btn btn-primary btn-sm" href="' . route('contract.show', $row->id) . '" title="View Contract">
                            <i class="fas fa-eye"></i>
                        </a>';
                    }
                }

                return $action ?: '-';
            })

            ->rawColumns(['action'])
            ->with(['columns' => $columns])
            ->toJson();
    }
}
