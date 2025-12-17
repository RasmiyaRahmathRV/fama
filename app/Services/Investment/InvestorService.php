<?php

namespace App\Services\Investment;

use App\Repositories\Investment\InvestorRepository;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class InvestorService
{
    public function __construct(
        protected InvestorRepository $investorRepo,
    ) {}


    public function getAll()
    {
        return $this->investorRepo->all();
    }

    public function getById($id)
    {
        return $this->investorRepo->find($id);
    }

    public function getByName($name)
    {
        return $this->investorRepo->getByName($name);
    }

    public function create(array $data, $user_id = null)
    {
        $this->validate($data);
        $data['added_by'] = $user_id ? $user_id : auth()->user()->id;
        $data['investor_code'] = $this->setInvestorCode();

        return $this->investorRepo->create($data);
    }

    public function update($id, array $data)
    {
        // $this->validate($data, $id);
        // $data['updated_by'] = auth()->user()->id;
        // return $this->investorRepo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->investorRepo->delete($id);
    }

    public function setInvestorCode($addval = 1)
    {
        $codeService = new \App\Services\CodeGeneratorService();
        return $codeService->generateNextCode('investors', 'investor_code', 'INVR', 5, $addval);
    }

    private function validate(array $data, $id = null)
    {
        // $validator = Validator::make($data, [
        //     'company_id' => 'required|exists:companies,id',
        //     'area_name' => [
        //         'required',
        //         'string',
        //         Rule::unique('areas')->ignore($id)
        //             ->where(fn($query) => $query->where('company_id', $data['company_id']))
        //             ->whereNull('deleted_at'),
        //     ],
        // ], [
        //     'area_name.unique' => 'This area name already exists. Please choose another.',
        // ]);

        // if ($validator->fails()) {
        //     throw new ValidationException($validator);
        // }
    }

    public function getDataTable(array $filters = [])
    {
        $query = $this->investorRepo->getQuery($filters);

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
            ->addColumn('action', function ($row) {
                $action = '';
                if (Gate::allows('area.edit')) {
                    $action .= '<button class="btn btn-info" data-toggle="modal"
                                                        data-target="#modal-area" data-id="' . $row->id . '"
                                                        data-name="' . $row->area_name . '"
                                                        data-company="' . $row->company_id . '">Edit</button>';
                }
                if (Gate::allows('area.delete')) {
                    $action .= '<button class="btn btn-danger ml-1" onclick="deleteConf(' . $row->id . ')" type="submit">Delete</button>';
                }

                return $action ?: '-';
            })
            ->rawColumns(['action'])
            ->with(['columns' => $columns]) // send columns too
            ->toJson();
    }
}
