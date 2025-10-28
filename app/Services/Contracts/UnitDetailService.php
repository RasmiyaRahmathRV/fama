<?php

namespace App\Services\Contracts;

use App\Models\ContractUnit;
use App\Repositories\Contracts\UnitDetailRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UnitDetailService
{
    public function __construct(
        protected UnitDetailRepository $unitdetRepo,
        protected SubUnitDetailService $subUnitdetServ,
    ) {}

    public function getAll()
    {
        return $this->unitdetRepo->all();
    }

    public function getById($id)
    {
        return $this->unitdetRepo->find($id);
    }

    public function create($contractData, array $dataArr, $unit_id, $user_id = null)
    {
        $data = [];
        // dd($dataArr);
        foreach ($dataArr['unit_type_id'] as $key => $value) {
            // dd('test');

            $partition = 0;
            $bedspace = 0;
            if (array_key_exists('partition', $dataArr)) {
                if ($dataArr['partition'][$key] == 1) {
                    $partition = 1;
                } else {
                    $bedspace = 1;
                }
            }

            $data[] = array(
                'contract_id' => $contractData->id,
                'contract_unit_id' => $unit_id,
                'added_by' => $user_id ? $user_id : auth()->user()->id,
                'unit_number' => $dataArr['unit_number'][$key],
                'unit_type_id' => $value,
                'floor_no' => $dataArr['floor_no'][$key],
                'unit_status_id' => $dataArr['unit_status_id'][$key],
                'unit_rent_per_annum' => $dataArr['unit_rent_per_annum'][$key],
                'unit_size_unit_id' => $dataArr['unit_size_unit_id'][$key],
                'unit_size' => $dataArr['unit_size'][$key],
                'property_type_id' => $dataArr['property_type_id'][$key],
                'partition' => $partition,
                'bedspace' => $bedspace,
                'total_partition' => $dataArr['total_partition'][$key] ?? 0,
                'total_bedspace' => $dataArr['total_bedspace'][$key] ?? 0,
                'rent_per_partition' => ($partition > 0) ? $dataArr['rent_per_partition'] : 0,
                'rent_per_bedspace' => ($bedspace > 0) ? $dataArr['rent_per_bedspace'] : 0,
                'rent_per_room' => ($bedspace == 0 && $partition == 0) ? $dataArr['rent_per_room'] : 0
            );
            // dd($data);
            $this->validate($data);
        }

        // dd($data);
        return DB::transaction(function () use ($data, $dataArr, $contractData, $unit_id, $user_id) {
            $unitDetId = $this->unitdetRepo->createMany($data);

            $subUnitData = array(
                'partition' => $dataArr['total_partition'],
                'bedspace' => $dataArr['total_bedspace'],
                'project_no' => $contractData->project_number,
                'contract_id' => $contractData->id,
                'contract_unit_id' => $unit_id,
                'company_code' => $contractData->company->company_short_code,
                'unit_no' => $dataArr['unit_number'],
                'unit_type' => $dataArr['unit_type_id'],
            );
            // dd($subUnitData);

            $this->subUnitdetServ->create($unitDetId, $subUnitData, $user_id);

            return $unitDetId;
        });


        return;
    }

    public function validate(array $data, $id = null)
    {
        $validator = Validator::make(['unit_detail' => $data], [
            'unit_detail' => 'required|array|min:1',
            'unit_detail.*.unit_type_id' => 'required',
            'unit_detail.*.floor_no' => 'required',
            'unit_detail.*.unit_status_id' => 'required',
            'unit_detail.*.unit_rent_per_annum' => 'required',
            'unit_detail.*.unit_size_unit_id' => 'required',
            'unit_detail.*.unit_size' => 'required',
            'unit_detail.*.property_type_id' => 'required',
            'unit_detail.*.unit_number' => [
                'nullable',
                function ($attribute, $value, $fail) use ($data) {
                    // Example: fetch the unit from DB (replace 'id' with your logic)
                    $unitId = $data['contract_unit_id'] ?? null;
                    $unit = ContractUnit::find($unitId);

                    if ($unit && $unit->unit != 1 && empty($value)) {
                        $fail('The unit number is required'); // because contract is not full building.
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated()['unit_detail'];
    }
}
