<?php

namespace App\Services\Contracts;

use App\Models\ContractSubunitDetail;
use App\Repositories\Contracts\SubUnitDetailRepository;

class SubUnitDetailService
{
    public function __construct(
        protected SubUnitDetailRepository $subunitdetRepo,
    ) {}

    public function getAll()
    {
        return $this->subunitdetRepo->all();
    }

    public function getById($id)
    {
        return $this->subunitdetRepo->find($id);
    }

    public function create($detailId, array $subUnitData, $user_id)
    {
        // dd($detailId);
        // dd($subUnitData);
        $subunitArr = [];
        foreach ($subUnitData['project_no'] as $key => $value) {
            $subunit_type = '0';
            for ($i = 1; $i <= $subUnitData['partition'][$key]; $i++) {
                if ($subUnitData['partition'][$key] > 0) {
                    $subunitno = 'P' . $i;
                    $subunit_type = '1';
                } else {
                    $subunitno = 'BS' . $i;
                    $subunit_type = '2';
                }

                $subunitcode = 'P' . $subUnitData['project_no'] . '/' . $subUnitData['company_code'] . '/' . $value . '/' . $subunitno;


                $subunitArr = array(
                    'contract_id' => $subUnitData['contract_id'],
                    'contract_unit_id' => $subUnitData['contract_unit_id'],
                    'contract_unit_detail_id' => $detailId[$key]->id,
                    'subunit_type' => $subunit_type,
                    'subunit_no' => $subunitno,
                    'subunit_code' => $subunitcode,
                    'added_by' => $user_id ? $user_id : auth()->user()->id,
                );

                $this->subunitdetRepo->create($subunitArr);
            }
        }
    }
}
