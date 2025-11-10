<?php

namespace App\Services\Contracts;

use App\Models\ContractSubunitDetail;
use App\Models\ContractUnitDetail;
use App\Repositories\Contracts\SubUnitDetailRepository;
use DB;

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
        foreach ($subUnitData['unit_type'] as $key => $value) {
            // dd($subUnitData);
            $subunitcount = subUnitCount($subUnitData, $key);
            // if (isset($subUnitData['is_partition'][$key])) {
            //     if ($subUnitData['is_partition'][$key] == '1') {
            //         $subunitcount = $subUnitData['partition'][$key];
            //     } else if ($subUnitData['is_partition'][$key] == '2') {
            //         $subunitcount = $subUnitData['bedspace'][$key];
            //     } else {
            //         $subunitcount = $subUnitData['room'][$key];
            //     }
            // } else {
            //     $subunitcount++;
            // }

            for ($i = 1; $i <= $subunitcount; $i++) {
                // print_r($detailId);
                // $subunit_type = '0';
                $subunit_type = subUnitType($subUnitData, $key);
                $subunitno = subunitNoGeneration($subUnitData, $key, $i);
                // if (isset($subUnitData['is_partition'][$key])) {
                //     if ($subUnitData['is_partition'][$key] == '1') {
                //         $subunitno = 'P' . $i;
                //         $subunit_type = '1';
                //     } else if ($subUnitData['is_partition'][$key] == '2') {
                //         $subunitno = 'BS' . $i;
                //         $subunit_type = '2';
                //     } else {
                //         $subunitno = 'R' . $i;
                //         $subunit_type = '3';
                //     }
                // } else {
                //     $subunitno = 'FL' . $i;
                //     $subunit_type = '4';
                // }

                $subunitcode = 'P' . $subUnitData['project_no'] . '/' . $subUnitData['company_code'] . '/' .  $subUnitData['unit_no'][$key] . '/' . $subunitno;
                // dd('aftercode');

                $subunitArr = array(
                    'contract_id' => $subUnitData['contract_id'],
                    'contract_unit_id' => $subUnitData['contract_unit_id'],
                    'contract_unit_detail_id' => $detailId[$key],
                    'subunit_type' => $subunit_type,
                    'subunit_no' => $subunitno,
                    'subunit_code' => $subunitcode,
                    'added_by' => $user_id ? $user_id : auth()->user()->id,
                );
                // dd($subunitArr);

                $this->subunitdetRepo->create($subunitArr);
            }
            // print_r('after loop');
        }
    }

    public function update($detailId, array $subUnitData, $user_id)
    {
        // dd($detailId);
        foreach ($subUnitData['unit_type'] as $key => $value) {
            // print_r('update loop ' . $key);
            $this->syncSubunits($subUnitData, $key, $detailId[$key], $user_id);
        }
    }

    public function syncSubunits($subUnitData, $key, $detailId, $user_id)
    {
        DB::transaction(function () use ($detailId, $subUnitData, $key, $user_id) {
            // dd('before');

            // if (isset($subUnitData['is_partition'][$key])) {
            //     if ($subUnitData['is_partition'][$key] == '1') {
            //         $subunit_type = '1';
            //     } else if ($subUnitData['is_partition'][$key] == '2') {
            //         $subunit_type = '2';
            //     } else {
            //         $subunit_type = '3';
            //     }
            // } else {
            //     $subunit_type = '4';
            // }

            $subunit_type = subUnitType($subUnitData, $key);

            // 🔹 Get existing subunits for this detail
            $existing = ContractSubunitDetail::where('contract_unit_detail_id', $detailId)
                ->where('subunit_type', $subunit_type)
                ->orderBy('id')
                ->get();

            $currentCount = $existing->count();

            // echo "</pre>";
            // print_r($subUnitData);
            $subunitcount = subUnitCount($subUnitData, $key);
            // if (isset($subUnitData['is_partition'][$key])) {
            //     if ($subUnitData['is_partition'][$key] == '1') {
            //         $subunitcount = $subUnitData['partition'][$key];
            //     } else if ($subUnitData['is_partition'][$key] == '2') {
            //         $subunitcount = $subUnitData['bedspace'][$key];
            //     } else {
            //         $subunitcount = $subUnitData['room'][$key];
            //     }
            // } else {
            //     $subunitcount++;
            // }
            // dd('before');
            $existPrevTypeId = $this->subunitdetRepo->existPrevSubType($detailId, $subUnitData['is_partition'][$key] ?? 0);
            // dd($existPrevTypeId);
            if ($existPrevTypeId) {
                ContractSubunitDetail::whereIn('id', $existPrevTypeId)->forceDelete();
            }


            // 🔹 CASE 1: Add missing subunits
            if ($currentCount < $subunitcount) {
                // print('case 1');
                $toAdd = $subunitcount - $currentCount;

                for ($j = 0; $j < $toAdd; $j++) {

                    $subunitno = subunitNoGeneration($subUnitData, $key, $currentCount + $j + 1);

                    // $this->createLoop($subUnitData, $key, $detailId[$key]->id, $user_id, $i, $subunit_type);
                    $this->createloop($subUnitData, $key, $detailId, $user_id, $subunit_type, $subunitno);
                }
            }

            // 🔹 CASE 2: Remove extra subunits
            elseif ($currentCount > $subunitcount) {
                // print('case 2');
                $toDelete = $currentCount - $subunitcount;

                // delete from the last entries
                $idsToDelete = $existing->sortByDesc('id')->take($toDelete)->pluck('id');
                ContractSubunitDetail::whereIn('id', $idsToDelete)->forceDelete();
            }

            // 🔹 CASE 3: Update existing if needed (optional)
            else {
                // print('case 3');
                for ($i = 1; $i <= $subunitcount; $i++) {
                    $subunitno = subunitNoGeneration($subUnitData, $key, $i);

                    $this->createloop($subUnitData, $key, $detailId, $user_id, $subunit_type, $subunitno);
                }
            }
        });
    }


    public function createloop($subUnitData, $key, $detailId, $user_id, $subunit_type, $subunitno)
    {
        $subunitcode = 'P' . $subUnitData['project_no'] . '/' . $subUnitData['company_code'] . '/' . $subUnitData['unit_no'][$key] . '/' . $subunitno;
        // print($subunitcode);
        $oldValue = ContractSubunitDetail::where(['contract_id' => $subUnitData['contract_id'], 'subunit_no' => $subunitno, 'subunit_code' => $subunitcode])->first();
        $existing = $this->subunitdetRepo->checkIfExist(['detail_id' => $detailId, 'subunit_no' => $subunitno]);

        $subunitArr = array(
            'contract_id' => $subUnitData['contract_id'],
            'contract_unit_id' => $subUnitData['contract_unit_id'],
            'contract_unit_detail_id' => $detailId, //detailId[$key]->id,
            'subunit_type' => $subunit_type,
            'subunit_no' => $subunitno,
            'subunit_code' => $subunitcode,
            'added_by' => $user_id ? $user_id : auth()->user()->id,
        );
        // dd($subunitArr);
        if ($oldValue || $existing) {
            if ($existing) {
                // dd('exist');
                if ($existing->trashed()) {
                    $existing->restore();
                    // print_r('restored');
                }
                $existing->fill($subunitArr);
                $existing->save();
            } else {
                $this->subunitdetRepo->update($oldValue->id, $subunitArr);
            }
        } else {
            $this->subunitdetRepo->create($subunitArr);
        }
    }


    public function markSubunitVacant($subunitId)
    {
        $subunit = ContractSubunitDetail::find($subunitId);

        if (!$subunit) {
            return;
        }

        $subunit->is_vacant = 1;
        $subunit->save();

        $unitId = $subunit->contract_unit_detail_id;

        $allVacant = ContractSubunitDetail::where('contract_unit_detail_id', $unitId)
            ->where('is_vacant', 0)
            ->doesntExist();

        if ($allVacant) {
            ContractUnitDetail::where('id', $unitId)
                ->update(['is_vacant' => 1]);
        }
    }
}
