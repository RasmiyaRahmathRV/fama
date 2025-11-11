<?php

namespace App\Services\Agreement;

use App\Models\Agreement;
use App\Models\AgreementDocument;
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
                'total_rent_annum' => $data['total_rent_per_annum']

            ];
            $payment = $this->agreementPaymentService->create($payment_data);
            $ct = Contract::with('contract_rentals', 'contract_unit')
                ->where('id', $agreement->contract_id)
                ->first();
            $count = $ct->contract_rentals->receivable_installments;
            $rent_annum = str_replace(',', '', $ct->contract_rentals->rent_receivable_per_annum);
            // dd($rent_annum);


            if ($data['contract_type'] == 2 || ($data['contract_type'] == 1 && $ct->contract_unit->business_type == 1)) {
                // Multiple unit insert
                foreach ($data['unit_detail'] as $unit) {
                    // $rent_annum_agreement = $unit['rent_per_month'] * $count;
                    $rent_annum_agreement = $rent_annum;
                    // dd($rent_annum_agreement);

                    $unitdata = [
                        'agreement_id' => $agreement->id,
                        'added_by' => $data['added_by'],
                        'unit_type_id' => $unit['unit_type_id'],
                        'contract_unit_details_id' => $unit['contract_unit_details_id'],
                        'contract_subunit_details_id' => $unit['contract_subunit_details_id'] ?? null,
                        'rent_per_month' => $unit['rent_per_month'],
                        'rent_per_annum_agreement' => $rent_annum_agreement,
                    ];
                    // dd($unitdata);

                    // Create agreement unit record
                    $createdUnit = $this->agreementUnitService->create($unitdata);
                    $agreementUnitId = $createdUnit->id ?? null;
                    // dd($agreementUnitId);

                    // Update contract/subunit vacancy
                    // ContractUnitDetail::where('id', $unitdata['contract_unit_details_id'])
                    //     ->update(['is_vacant' => 1]);
                    // // dd("test");
                    // ContractSubunitDetail::where('contract_unit_detail_id', $unitdata['contract_unit_details_id'])
                    //     ->update(['is_vacant' => 1]);
                    // // dd("test");


                    // Now handle payments related to this unit
                    if (!empty($data['payment_detail'][$unit['contract_unit_details_id']])) {
                        // dd("tet");
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
                            // dd($detail_data);

                            $this->agreementPaymentDetailService->create($detail_data);
                            // dd("testr");
                        }
                    }
                    // $this->subUnitDetailserv->markSubunitVacant(
                    //     $unit['contract_unit_details_id'],
                    //     $unit['contract_subunit_details_id'] ?? null
                    // );
                    $this->subUnitDetailserv->allVacant(
                        $agreement->contract_id
                    );
                }
            } else {
                // dd("test");
                // Default single insert (contract type != 2)
                // $rent_annum_agreement = $data['rent_per_month'] * $count;
                $rent_annum_agreement = $data['total_rent_per_annum'];

                // dd($rent_annum_agreement);
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
                $this->subUnitDetailserv->markSubunitVacant($data['contract_unit_details_id'], $data['contract_subunit_details_id'] ?? null);
            }

            // dd("testsub");
            $contract_id = $ct->id;

            $this->contractService->updateAgreementStatus($contract_id);


            // $this->subUnitDetailserv->markSubunitVacant($data['contract_subunit_details_id']);
            // $contract_id = $ct->id;
            // $this->contractService->updateAgreementStatus($contract_id);




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
        // dd($data);
        $this->validate($data, $id); // You can have separate validation for update
        $data['updated_by'] = auth()->user()->id;

        DB::beginTransaction();

        try {
            // STEP 1: Update Agreement
            $agreement = $this->agreementRepository->find($id);
            // dd($agreement);

            $agreementData = [
                'company_id' => $data['company_id'] ?? $agreement->company_id,
                'contract_id' => $data['contract_id'] ?? $agreement->contract_id,
                'start_date' => $data['start_date'] ?? $agreement->start_date,
                'end_date' => $data['end_date'] ?? $agreement->end_date,
                'duration_in_months' => $data['duration_in_months'] ?? $agreement->duration_in_months,
                'updated_by' => $data['updated_by'],
            ];

            $this->agreementRepository->update($id, $agreementData);
            $documents_id = AgreementDocument::where('agreement_id', $id)->pluck('id');
            // dd($data['documents'], $documents_id);
            // dd($data['documents']);
            $this->agreementDocumentService->update($agreement, $data['documents'], $data['updated_by']);

            // STEP 3: Update Tenant Info

            $tenantData = [
                'tenant_name' => $data['tenant_name'],
                'tenant_mobile' => $data['tenant_mobile'] ?? null,
                'tenant_email' => $data['tenant_email'] ?? null,
                'nationality_id' => $data['nationality_id'] ?? null,
                'tenant_address' => $data['tenant_address'] ?? null,
                'updated_by' => $data['updated_by'],
                'id' => $data['tenant_id']
            ];
            $this->agreementTenantService->update($tenantData);

            $payment_data = [
                'agreement_id' => $agreement->id,
                'installment_id' => $data['installment_id'] ?? null,
                'interval' => $data['interval'] ?? null,
                'beneficiary' => $data['beneficiary'] ?? null,
                'updated_by' => $data['updated_by'],
                'total_rent_annum' => $data['total_rent_per_annum'],
                'id' => $data['payment_id']

            ];
            $payment = $this->agreementPaymentService->update($payment_data);

            // STEP 4: Update Units & Vacancies
            $ct = Contract::with('contract_rentals', 'contract_unit')
                ->where('id', $agreement->contract_id)
                ->first();
            // dd($ct);
            $count = $ct->contract_rentals->receivable_installments;
            // $rent_annum = $ct->contract_rentals->rent_receivable_per_annum;
            $rent_annum = str_replace(',', '', $ct->contract_rentals->rent_receivable_per_annum);


            // dd($data['unit_detail']);


            // Insert updated units
            if ($data['contract_type'] == 2 || ($data['contract_type'] == 1 && $ct->contract_unit->business_type == 1)) {
                $unitids = $this->agreementRepository->findunits($id);
                // dd($unitids);
                foreach ($data['unit_detail'] as $index => &$unit) {
                    if (isset($unitids[$index])) {
                        $unit['agreement_unit_id'] = $unitids[$index];
                    } else {
                        $unit['agreement_unit_id'] = null;
                    }
                }
                unset($unit);
                foreach ($data['unit_detail'] as $unit) {
                    // $rent_annum_agreement = $unit['rent_per_month'] * $count;
                    $rent_annum_agreement = $rent_annum;
                    $unitData = [
                        'agreement_id' => $agreement->id,
                        'updated_by' => $data['updated_by'],
                        'unit_type_id' => $unit['unit_type_id'],
                        'contract_unit_details_id' => $unit['contract_unit_details_id'],
                        'contract_subunit_details_id' => $unit['contract_subunit_details_id'] ?? null,
                        'rent_per_month' => $unit['rent_per_month'],
                        'rent_per_annum_agreement' => $rent_annum_agreement,
                        'id' => $unit['agreement_unit_id']
                    ];

                    $createdUnit = $this->agreementUnitService->update($unitData);
                    // dd($createdUnit);

                    // Update vacancies
                    // ContractUnitDetail::where('id', $unitData['contract_unit_details_id'])->update(['is_vacant' => 1]);
                    // ContractSubunitDetail::where('contract_unit_detail_id', $unitData['contract_unit_details_id'])->update(['is_vacant' => 1]);

                    // Update Payments
                    // if (!empty($data['payment_detail'][$unit['agreement_unit_id']])) {
                    // dd('test');

                    foreach ($data['payment_detail'][$unit['agreement_unit_id']] as $detail) {
                        if (empty($detail['payment_mode_id']) || empty($detail['payment_amount'])) continue;
                        // dd($detail);

                        $detail_data = [
                            'agreement_id' => $agreement->id,
                            'agreement_payment_id' => $payment->id,
                            'contract_unit_id' => $unitData['contract_unit_details_id'],
                            'agreement_unit_id' => $createdUnit->id,
                            'payment_mode_id' => $detail['payment_mode_id'],
                            'payment_date' => $detail['payment_date'] ?? null,
                            'payment_amount' => $detail['payment_amount'],
                            'bank_id' => $detail['bank_id'] ?? null,
                            'cheque_number' => $detail['cheque_number'] ?? null,
                            'updated_by' => $data['updated_by'],
                            'id' => $detail['detail_id']
                        ];
                        // dd($detail_data);

                        $this->agreementPaymentDetailService->update($detail_data);
                    }
                    // }
                    $this->subUnitDetailserv->markSubunitVacant(
                        $unitData['contract_unit_details_id'],
                        $unitData['contract_subunit_details_id'] ?? null
                    );
                }
            } else {
                // Default single insert (contract type != 2)
                // $rent_annum_agreement = $data['rent_per_month'] * $count;
                $rent_annum_agreement = $data['total_rent_per_annum'];

                // in the case of untnumber change
                $exisistingUnit = $this->agreementUnitService->getById($data['unit_id']);
                if ($exisistingUnit->contract_unit_details_id != $data['contract_unit_details_id']) {
                    ContractUnitDetail::where('id', $exisistingUnit->contract_unit_details_id)->update(['is_vacant' => 0]);
                }
                if ($exisistingUnit->contract_subunit_details_id != $data['contract_subunit_details_id']) {
                    ContractSubunitDetail::where('id', $exisistingUnit->contract_subunit_details_id)->update(['is_vacant' => 0]);
                }


                $unitdata = [
                    'agreement_id' => $agreement->id,
                    'updated_by' => $data['updated_by'],
                    'unit_type_id' => $data['unit_type_id'],
                    'contract_unit_details_id' => $data['contract_unit_details_id'],
                    'contract_subunit_details_id' => $data['contract_subunit_details_id'] ?? null,
                    'rent_per_month' => $data['rent_per_month'],
                    'rent_per_annum_agreement' => $rent_annum_agreement,
                    'id' => $data['unit_id']
                ];

                $updatedUnit = $this->agreementUnitService->update($unitdata);
                $agreementUnitId = $updatedUnit->id ?? null;

                // STEP 1: Get existing payment detail IDs from DB
                $existingPaymentIds = $this->agreementPaymentDetailService
                    ->getByAgreementId($agreement->id)
                    ->pluck('id')
                    ->toArray();

                //  STEP 2: Collect new IDs from the request
                $newPaymentIds = collect($data['payment_detail'] ?? [])
                    ->pluck('id')
                    ->filter()
                    ->toArray();

                //  STEP 3: Find which ones to delete
                $toDelete = array_diff($existingPaymentIds, $newPaymentIds);

                // dd($toDelete);

                // 🧹 Delete removed payments
                if (!empty($toDelete)) {
                    $this->agreementPaymentDetailService->deleteByIds($toDelete);
                }

                foreach ($data['payment_detail'] ?? [] as $detail) {
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
                        'updated_by' => $data['updated_by'],
                        'id' => $detail['id'] ?? null,
                    ];

                    // Update existing or create new
                    $this->agreementPaymentDetailService->updateOrCreate($detail_data);
                }

                // foreach ($data['payment_detail'] ?? [] as $detail) {
                //     if (empty($detail['payment_mode_id']) || empty($detail['payment_amount'])) {
                //         continue;
                //     }

                //     $detail_data = [
                //         'agreement_id' => $agreement->id,
                //         'agreement_payment_id' => $payment->id,
                //         'agreement_unit_id' => $agreementUnitId ?? null,
                //         'payment_mode_id' => $detail['payment_mode_id'],
                //         'payment_date' => $detail['payment_date'] ?? null,
                //         'payment_amount' => $detail['payment_amount'],
                //         'bank_id' => $detail['bank_id'] ?? null,
                //         'cheque_number' => $detail['cheque_number'] ?? null,
                //         'updated_by' => $data['updated_by'],
                //         'id' => $detail['id'] ?? null,
                //     ];

                //     $this->agreementPaymentDetailService->update($detail_data);
                // }
                $this->subUnitDetailserv->markSubunitVacant($data['contract_unit_details_id'], $data['contract_subunit_details_id'] ?? null);
            }


            //STEP 5: Update Contract Status if needed
            $this->contractService->updateAgreementStatus($ct->id);

            DB::commit();

            return $agreement;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }


    private function validate($data, $id = null)
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
            ['data' => 'tenant_details', 'name' => 'tenant_details'],
            ['data' => 'start_date', 'name' => 'start_date'],
            ['data' => 'end_date', 'name' => 'end_date'],
            ['data' => 'created_at', 'name' => 'created_at'],
            ['data' => 'action', 'name' => 'action', 'orderable' => true, 'searchable' => true],
        ];

        return datatables()
            ->of($query)
            ->addIndexColumn()
            ->addColumn('agreement_code', fn($row) =>  ucfirst($row->agreement_code) ?? '-')
            ->addColumn('company_name', fn($row) => $row->company->company_name ?? '-')
            // ->addColumn('project_number', fn($row) => 'P - ' . $row->contract->project_number ?? '-')
            ->addColumn('project_number', function ($row) {
                $number = 'P - ' . $row->contract->project_number ?? '-';
                $type = $row->contract_type ?? '-';

                return "<strong class=''>{$number}</strong><p class='mb-0'>{$type}</p>
                </p>";
            })
            ->addColumn('tenant_details', function ($row) {
                $name = $row->tenant_name ?? '-';
                $email = $row->tenant_email ?? '-';
                $phone = $row->tenant_mobile ?? '-';

                return "<strong class='text-capitalize'>{$name}</strong><p class='mb-0 text-primary'>{$email}</p><p class='text-muted small'>
                    <i class='fa fa-phone-alt text-danger'></i> <span class='font-weight-bold'>{$phone}</span>
                </p>";
            })
            ->addColumn('start_date', fn($row) => $row->start_date ?? '-')
            ->addColumn('end_date', fn($row) => $row->end_date ?? '-')
            ->addColumn('created_at', fn($row) => $row->created_at ?? '-')


            ->addColumn('action', function ($row) {
                $editUrl = route('agreement.edit', $row->id);
                $printUrl = route('agreement.printview', $row->id);
                $action = '
                <a href="view_installments.php" class="btn btn-primary btn-sm"
                    title="View Installments"><i class="fas fa-eye"></i></a>
                <a href="agreement_documents.php" class="btn btn-warning btn-sm"
                    title="documents"><i class="fas fa-file"></i></a>
                <a href="' . $printUrl . '" class="btn btn-primary btn-sm"
                    title="Agreement"><i class="fas fa-handshake"></i></a>
                <a href="' . $editUrl . '" class="btn btn-info  btn-sm" title="Edit agreement"><i
                        class="fas fa-pencil-alt"></i></a>
                <a class="btn btn-danger  btn-sm" onclick="deleteConf()" title="delete"><i
                        class="fas fa-trash"></i></a>
                <a href="#" class="btn btn-danger btn-sm" title="Terminate"
                    data-toggle="modal" data-target="#modal-terminate"><i
                        class="fas fa-file-signature"></i></a>
                ';



                return $action ?: '-';
            })

            ->rawColumns(['tenant_details', 'action', 'project_number'])
            // ->rawColumns(['action'])
            ->with(['columns' => $columns])
            ->toJson();
    }
    public function getDetails($id)
    {
        return $this->agreementRepository->getDetails($id);
    }
}
