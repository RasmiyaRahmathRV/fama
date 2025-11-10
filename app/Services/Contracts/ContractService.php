<?php

namespace App\Services\Contracts;

use App\Models\Contract;
use App\Models\ContractUnitDetail;
use App\Repositories\Contracts\ContractRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use App\Models\{
    Installment,
    PaymentMode,
    Bank,
    ContractType,
    UnitType,
    UnitStatus,
    UnitSizeUnit
};
use App\Services\AreaService;
use App\Services\CompanyService;
use App\Services\InstallmentService;
use App\Services\LocalityService;
use App\Services\PropertyService;
use App\Services\PropertyTypeService;
use App\Services\VendorService;

class ContractService
{
    public function __construct(
        protected ContractRepository $contractRepo,
        protected ContractDetailService $detailServ,
        protected OtcService $otcServ,
        protected PaymentService $paymentServ,
        protected PaymentDetailService $paymentdetServ,
        protected UnitService $unitServ,
        protected UnitDetailService $unitDetServ,
        protected RentalService $rentalServ,

        protected CompanyService $companyService,
        protected LocalityService $localityService,
        protected AreaService $areaService,
        protected PropertyTypeService $propertyTypeServ,
        protected PropertyService $propertyServ,
        protected InstallmentService $installmentServ,
        protected VendorService $vendorServ,
    ) {}

    public function getAll()
    {
        return $this->contractRepo->all();
    }

    public function getById($id)
    {
        return $this->contractRepo->find($id);
    }

    public function getAllDataById($id)
    {
        return $this->contractRepo->getAllDataById($id);
    }

    public function getDropdownData(): array
    {
        return [
            'companies' => $this->companyService->getAll(),
            'localities' => $this->localityService->getAll(),
            'areas' => $this->areaService->getAll(),
            'property_types' => $this->propertyTypeServ->getAll(),
            'properties' => $this->propertyServ->getAll(),
            'installments' => $this->installmentServ->getAll(),
            'vendors' => $this->vendorServ->getAll(),
            'installments' => Installment::all(),
            'paymentmodes' => PaymentMode::all(),
            'banks' => Bank::all(),
            'contractTypes' => ContractType::all(),
            'UnitTypes' => UnitType::all(),
            'UnitStatus' => UnitStatus::all(),
            'UnitSizeUnit' => UnitSizeUnit::all(),
        ];
    }

    public function createOrRestore(array $data, $user_id = null)
    {
        // print_r($data);
        $data['contract']['added_by'] = $user_id ? $user_id : auth()->user()->id;
        $data['contract']['project_code'] = $this->setProjectCode();

        return DB::transaction(function () use ($data) {
            $this->validate($data['contract'], $data['contract']['id'] ?? null);

            $contract = $this->contractRepo->create($data['contract']);
            // Store related details


            $this->detailServ->create($contract->id, $data['detail'] ?? []);

            $unitData = $this->unitServ->create($contract->id, $data['unit'] ?? [], $data['unit_detail'] ?? []);

            $this->unitDetServ->create($contract, $data['unit_detail'] ?? [], $data['rentals']['receivable_installments'], $unitData->id);
            // dd($contract);
            $this->rentalServ->create($contract->id, $data['rentals'] ?? []);
            $this->otcServ->create($contract->id, $data['otc'] ?? []);

            $this->paymentServ->create($contract->id, $data['payment'] ?? [], $data['payment_detail'] ?? [], $data['receivables'] ?? []);


            return $contract;
        });
        // $existing = $this->contractRepo->checkIfExist($data);

        // if ($existing) {
        //     if ($existing->trashed()) {
        //         $existing->restore();
        //     }
        //     $existing->fill($data);
        //     $existing->save();
        //     return $existing;
        // }

        // return $this->contractRepo->create($data);
    }

    public function setProjectCode($addval = 1)
    {
        $codeService = new \App\Services\CodeGeneratorService();
        return $codeService->generateNextCode('contracts', 'project_code', 'PRJ', 5, $addval);
    }

    public function update($id, array $data)
    {
        // dd($data);
        return DB::transaction(function () use ($id, $data) {
            $data['contract']['updated_by'] = auth()->user()->id;
            $this->validate($data['contract'], $data['contract']['id'] ?? null);

            $contract = $this->contractRepo->update($id, $data['contract']);
            // Store related details


            $this->detailServ->update($data['detail'] ?? []);
            $unitData = $this->unitServ->update($data['unit'] ?? [], $data['unit_detail'] ?? []);

            $this->unitDetServ->update($contract, $data['unit_detail'] ?? [], $data['rentals']['receivable_installments'], $unitData->id);
            // dd($unitData);
            $this->rentalServ->update($data['rentals'] ?? []);
            $this->otcServ->update($data['otc'] ?? []);

            $this->paymentServ->update($id, $data['payment'] ?? [], $data['payment_detail'] ?? [], $data['receivables'] ?? []);


            return $contract;
        });

        // return $this->contractRepo->update($id, $data);
    }

    private function validate(array $data, $id = null)
    {
        $validator = Validator::make($data, [
            'project_number' => [
                'required',
                'string',
                Rule::unique('contracts')->ignore($id)
                    ->where(fn($query) => $query->where('company_id', $data['company_id']))
                    ->whereNull('deleted_at'),
            ],
            'company_id' => 'required',
            'vendor_id' => 'required',
            'contract_type_id' => 'required',
            'area_id' => 'required',
            'locality_id' => 'required',
            'property_id' => 'required',
        ], [
            'project_number.unique' => 'This project number already exists. Please choose another.',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    // public function checkIfExist($data)
    // {
    //     return $this->contractRepo->checkIfExist($data);
    // }

    public function delete($id)
    {
        return $this->contractRepo->delete($id);
    }

    public function getDataTable(array $filters = [])
    {
        $query = $this->contractRepo->getQuery($filters);
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
    public function getAllwithUnits()
    {
        return $this->contractRepo->allwithUnits();
    }

    public function updateAgreementStatus($id)
    {
        $units = ContractUnitDetail::where('contract_id', $id)
            ->with('contractSubUnitDetails')
            ->get();
        Contract::where('id', $id)
            ->update(['has_agreement' =>  1]);

        $allVacant = $units->every(function ($unit) {
            $unitVacant = $unit->is_vacant == 1;

            $subUnitsVacant = $unit->contractSubUnitDetails->every(function ($sub) {
                return $sub->is_vacant == 1;
            });

            return $unitVacant && $subUnitsVacant;
        });

        if ($allVacant) {
            return Contract::where('id', $id)->update(['is_agreement_added' => 1]);
        }

        return false;
    }

    public function fullContracts()
    {
        return $this->contractRepo->fullContracts();
    }
}
