<?php

namespace App\Services\Contracts;

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
        foreach ($dataArr['unit_number'] as $key => $value) {

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
                'unit_number' => $value,
                'unit_type_id' => $dataArr['unit_type_id'][$key],
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
            );

            $this->subUnitdetServ->create($unitDetId, $subUnitData, $user_id);

            return $unitDetId;
        });


        return;
    }

    private function validate(array $data, $id = null)
    {
        $validator = Validator::make($data, [
            // 'nationality_name' => [
            //     'required',
            //     Rule::unique('nationalities')->ignore($id)
            //         ->where(fn($q) => $q
            //             // ->where('company_id', $data['company_id'])
            //             ->whereNull('deleted_at'))
            // ],
            // 'nationality_short_code' => 'required',
            // 'company_id' => 'required|exists:companies,id',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
