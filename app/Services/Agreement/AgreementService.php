<?php

namespace App\Services\Agreement;

use App\Models\Contract;
use App\Models\ContractSubunitDetail;
use App\Models\ContractUnitDetail;
use App\Repositories\Agreement\AgreementDocRepository;
use App\Repositories\Agreement\AgreementPaymentDetailRepository;
use App\Repositories\Agreement\AgreementPaymentRepository;
use App\Repositories\Agreement\AgreementRepository;
use App\Repositories\Agreement\AgreementTenantRepository;
use App\Repositories\Agreement\AgreementUnitRepository;
use App\Services\Contracts\ContractService;
use App\Services\Contracts\SubUnitDetailService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AgreementService
{
    public function __construct(
        protected AgreementRepository $agreementRepository,
        protected AgreementDocRepository $agreementDocRepository,
        protected AgreementTenantRepository $agreementTenantRepository,
        protected AgreementPaymentRepository $agreementPaymentRepository,
        protected AgreementPaymentDetailRepository $agreementPaymentDetailRepository,
        protected AgreementUnitRepository $agreementUnitRepository,
        protected AgreementTenantService $agreementTenantService,
        protected AgreementPaymentDetailService $agreementPaymentDetailService,
        protected AgreementPaymentService $agreementPaymentService,
        protected AgreementUnitService $agreementUnitService,
        protected AgreementDocumentService $agreementDocumentService,
        protected SubUnitDetailService $subUnitDetailserv,
        protected ContractService $contractService

    ) {}



    public function getAll()
    {
        return $this->agreementRepository->all();
    }

    public function getById($id)
    {
        return $this->agreementRepository->find($id);
    }

    public function createOrRestore(array $data, $user_id = null)
    {
        $this->validate($data);
        $data['added_by'] = $user_id ?: auth()->user()->id;
        $data['agreement_code'] = $this->setProjectCode();

        DB::beginTransaction();

        // dd($data);


        try {
            // STEP 1: Create Agreement
            $agreementData = [
                'company_id' => $data['company_id'],
                'contract_id' => $data['contract_id'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'duration_in_months' => $data['duration_in_months'],
                'added_by' => $data['added_by'],
                'agreement_code' => $data['agreement_code'],
            ];
            $this->validate($agreementData);

            // dd('test');

            $agreement = $this->agreementRepository->create($agreementData);
            // dd($agreement);
            $this->agreementDocumentService->storeDocuments(
                $agreement,
                $data['documents'] ?? [],
                $data['added_by']
            );

            // STEP 3: Insert Tenant Info
            $tenantData = [
                'agreement_id' => $agreement->id,
                'tenant_name' => $data['tenant_name'] ?? null,
                'tenant_mobile' => $data['tenant_mobile'] ?? null,
                'tenant_email' => $data['tenant_email'] ?? null,
                'nationality_id' => $data['nationality_id'] ?? null,
                'tenant_address' => $data['tenant_address'] ?? null,
                'added_by' => $data['added_by'],

            ];

            $this->agreementTenantService->create($tenantData);

            $payment_data = [
                'agreement_id' => $agreement->id,
                'installment_id' => $data['installment_id'] ?? null,
                'interval' => $data['interval'] ?? null,
                'beneficiary' => $data['beneficiary'] ?? null,
                'added_by' => $data['added_by'],

            ];
            $payment = $this->agreementPaymentService->create($payment_data);
            $ct = Contract::with('contract_rentals', 'contract_unit')
                ->where('id', $agreement->contract_id)
                ->first();
            $count = $ct->contract_rentals->receivable_installments;


            // if ($data['contract_type'] == 2 || ($data['contract_type'] == 1 && $ct->contract_unit->business_type == 1)) {
            //     // dd('test');
            //     foreach ($data['unit_detail'] as $unit) {
            //         $rent_annum_agreement = $unit['rent_per_month'] * $count;
            //         $unitdata = [
            //             'agreement_id' => $agreement->id,
            //             'added_by' => $data['added_by'],
            //             'unit_type_id' => $unit['unit_type_id'],
            //             'contract_unit_details_id' => $unit['contract_unit_details_id'],
            //             'contract_subunit_details_id' => $unit['contract_subunit_details_id'] ?? null,
            //             'rent_per_month' => $unit['rent_per_month'],
            //             'rent_per_annum_agreement' => $rent_annum_agreement,
            //         ];
            //         $this->agreementUnitService->create($unitdata);
            //         ContractUnitDetail::where('id', $unitdata['contract_unit_details_id'])
            //             ->update(['is_vacant' => 1]);
            //         ContractSubunitDetail::where('contract_unit_detail_id', $unitdata['contract_unit_details_id'])
            //             ->update(['is_vacant' => 1]);
            //     }
            // } else {
            //     // Default single insert (contract type != 2)
            //     $rent_annum_agreement = $data['rent_per_month'] * $count;
            //     $unitdata = [
            //         'agreement_id' => $agreement->id,
            //         'added_by' => $data['added_by'],
            //         'unit_type_id' => $data['unit_type_id'],
            //         'contract_unit_details_id' => $data['contract_unit_details_id'],
            //         'contract_subunit_details_id' => $data['contract_subunit_details_id'] ?? null,
            //         'rent_per_month' => $data['rent_per_month'],
            //         'rent_per_annum_agreement' => $rent_annum_agreement,
            //     ];
            //     $createdUnit = $this->agreementUnitService->create($unitdata);
            //     $agreementUnitId = $createdUnit->id ?? null;
            // }


            // // if ($data['contract_type'] == 2) {
            // if (($data['contract_type'] == 2) || ($data['contract_type'] == 1  && $ct->contract_unit->business_type == 1)) {
            //     // dd('test');

            //     foreach ($data['payment_detail'] as $unitId => $installments) {
            //         foreach ($installments as $detail) {
            //             // Skip empty rows if needed
            //             if (empty($detail['payment_mode_id']) || empty($detail['payment_amount'])) {
            //                 continue;
            //             }

            //             $detail_data = [
            //                 'agreement_id' => $agreement->id,
            //                 'agreement_payment_id' => $payment->id,
            //                 'contract_unit_id' => $unitId,
            //                 'payment_mode_id' => $detail['payment_mode_id'],
            //                 'payment_date' => $detail['payment_date'] ?? null,
            //                 'payment_amount' => $detail['payment_amount'],
            //                 'bank_id' => $detail['bank_id'] ?? null,
            //                 'cheque_number' => $detail['cheque_number'] ?? null,
            //                 'added_by' => $data['added_by'],
            //             ];

            //             $this->agreementPaymentDetailService->create($detail_data);
            //         }
            //     }
            // } else {
            //     // default for other contract types (flat structure)
            //     foreach ($data['payment_detail'] as $detail) {
            //         if (empty($detail['payment_mode_id']) || empty($detail['payment_amount'])) {
            //             continue;
            //         }

            //         $detail_data = [
            //             'agreement_id' => $agreement->id,
            //             'agreement_payment_id' => $payment->id,
            //             'agreemant_unit_id' => $agreementUnitId,
            //             'payment_mode_id' => $detail['payment_mode_id'],
            //             'payment_date' => $detail['payment_date'] ?? null,
            //             'payment_amount' => $detail['payment_amount'],
            //             'bank_id' => $detail['bank_id'] ?? null,
            //             'cheque_number' => $detail['cheque_number'] ?? null,
            //             'added_by' => $data['added_by'],
            //         ];

            //         $this->agreementPaymentDetailService->create($detail_data);
            //     }
            // }
            if ($data['contract_type'] == 2 || ($data['contract_type'] == 1 && $ct->contract_unit->business_type == 1)) {
                // Multiple unit insert
                foreach ($data['unit_detail'] as $unit) {
                    $rent_annum_agreement = $unit['rent_per_month'] * $count;

                    $unitdata = [
                        'agreement_id' => $agreement->id,
                        'added_by' => $data['added_by'],
                        'unit_type_id' => $unit['unit_type_id'],
                        'contract_unit_details_id' => $unit['contract_unit_details_id'],
                        'contract_subunit_details_id' => $unit['contract_subunit_details_id'] ?? null,
                        'rent_per_month' => $unit['rent_per_month'],
                        'rent_per_annum_agreement' => $rent_annum_agreement,
                    ];

                    // Create agreement unit record
                    $createdUnit = $this->agreementUnitService->create($unitdata);
                    $agreementUnitId = $createdUnit->id ?? null;

                    // Update contract/subunit vacancy
                    ContractUnitDetail::where('id', $unitdata['contract_unit_details_id'])
                        ->update(['is_vacant' => 1]);
                    ContractSubunitDetail::where('contract_unit_detail_id', $unitdata['contract_unit_details_id'])
                        ->update(['is_vacant' => 1]);

                    // Now handle payments related to this unit
                    if (!empty($data['payment_detail'][$unit['contract_unit_details_id']])) {
                        foreach ($data['payment_detail'][$unit['contract_unit_details_id']] as $detail) {
                            if (empty($detail['payment_mode_id']) || empty($detail['payment_amount'])) {
                                continue;
                            }

                            $detail_data = [
                                'agreement_id' => $agreement->id,
                                'agreement_payment_id' => $payment->id,
                                'contract_unit_id' => $unit['contract_unit_details_id'],
                                'agreement_unit_id' => $agreementUnitId,
                                'payment_mode_id' => $detail['payment_mode_id'],
                                'payment_date' => $detail['payment_date'] ?? null,
                                'payment_amount' => $detail['payment_amount'],
                                'bank_id' => $detail['bank_id'] ?? null,
                                'cheque_number' => $detail['cheque_number'] ?? null,
                                'added_by' => $data['added_by'],
                            ];

                            $this->agreementPaymentDetailService->create($detail_data);
                        }
                    }
                }
            } else {
                // Default single insert (contract type != 2)
                $rent_annum_agreement = $data['rent_per_month'] * $count;
                $unitdata = [
                    'agreement_id' => $agreement->id,
                    'added_by' => $data['added_by'],
                    'unit_type_id' => $data['unit_type_id'],
                    'contract_unit_details_id' => $data['contract_unit_details_id'],
                    'contract_subunit_details_id' => $data['contract_subunit_details_id'] ?? null,
                    'rent_per_month' => $data['rent_per_month'],
                    'rent_per_annum_agreement' => $rent_annum_agreement,
                ];

                $createdUnit = $this->agreementUnitService->create($unitdata);
                $agreementUnitId = $createdUnit->id ?? null;

                foreach ($data['payment_detail'] as $detail) {
                    if (empty($detail['payment_mode_id']) || empty($detail['payment_amount'])) {
                        continue;
                    }

                    $detail_data = [
                        'agreement_id' => $agreement->id,
                        'agreement_payment_id' => $payment->id,
                        'agreement_unit_id' => $agreementUnitId,
                        'payment_mode_id' => $detail['payment_mode_id'],
                        'payment_date' => $detail['payment_date'] ?? null,
                        'payment_amount' => $detail['payment_amount'],
                        'bank_id' => $detail['bank_id'] ?? null,
                        'cheque_number' => $detail['cheque_number'] ?? null,
                        'added_by' => $data['added_by'],
                    ];

                    $this->agreementPaymentDetailService->create($detail_data);
                }
            }



            $this->subUnitDetailserv->markSubunitVacant($data['contract_subunit_details_id']);
            $contract_id = $ct->id;
            $this->contractService->updateAgreementStatus($contract_id);




            DB::commit();

            return $agreement;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function setProjectCode($addval = 1)
    {
        $codeService = new \App\Services\CodeGeneratorService();
        return $codeService->generateNextCode('agreements', 'agreement_code', 'AGR', 5, $addval);
    }

    public function update($id, array $data)
    {
        $this->validate($data, $id);
        $data['updated_by'] = auth()->user()->id;
        return $this->agreementRepository->update($id, $data);
    }

    private function validate(array $data, $id = null)
    {
        $validator = Validator::make($data, [
            'company_id' => 'required',
            'contract_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'duration_in_months' => 'required'
        ], []);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
    public function getDataTable(array $filters = [])
    {
        $query = $this->agreementRepository->getQuery($filters);
        // dd($query);

        $columns = [
            ['data' => 'DT_RowIndex', 'name' => 'id'],
            ['data' => 'agreemant_code', 'name' => 'agreemant_code'],
            ['data' => 'company_name', 'name' => 'company_name'],
            ['data' => 'project_number', 'name' => 'project_number'],
            ['data' => 'start_date', 'name' => 'start_date'],
            ['data' => 'end_date', 'name' => 'end_date'],
            ['data' => 'action', 'name' => 'action', 'orderable' => true, 'searchable' => true],
        ];

        return datatables()
            ->of($query)
            ->addIndexColumn()
            ->addColumn('agreement_code', fn($row) => ucfirst($row->agreement_code) ?? '-')
            ->addColumn('company_name', fn($row) => $row->company->company_name ?? '-')
            ->addColumn('project_number', fn($row) => $row->contract->project_number ?? '-')
            ->addColumn('start_date', fn($row) => $row->start_date ?? '-')
            ->addColumn('end_date', fn($row) => $row->end_date ?? '-')

            ->addColumn('action', function ($row) {
                $action = '
                <a href="view_installments.php" class="btn btn-primary btn-sm"
                    title="View Installments"><i class="fas fa-eye"></i></a>
                <a href="agreement_documents.php" class="btn btn-warning btn-sm"
                    title="documents"><i class="fas fa-file"></i></a>
                <a href="view_agreement.php?1" class="btn btn-primary btn-sm"
                    title="Agreement"><i class="fas fa-handshake"></i></a>
                <a class="btn btn-info  btn-sm" data-toggle="modal"
                    data-target="#modal-agreement" title="Edit agreement"><i
                        class="fas fa-pencil-alt"></i></a>
                <a class="btn btn-danger  btn-sm" onclick="deleteConf()" title="delete"><i
                        class="fas fa-trash"></i></a>
                <a href="#" class="btn btn-danger btn-sm" title="Terminate"
                    data-toggle="modal" data-target="#modal-terminate"><i
                        class="fas fa-file-signature"></i></a>
                ';



                return $action ?: '-';
            })

            ->rawColumns(['action'])
            ->with(['columns' => $columns])
            ->toJson();
    }
}
