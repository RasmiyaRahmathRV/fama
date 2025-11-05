<?php

namespace App\Repositories\Contracts;

use App\Models\ContractSubunitDetail;

class SubUnitDetailRepository
{
    public function all()
    {
        return ContractSubunitDetail::all();
    }

    public function find($id)
    {
        return ContractSubunitDetail::findOrFail($id);
    }

    public function getByName($contractSubun)
    {
        return ContractSubunitDetail::where($contractSubun)->first();
    }

    public function create($data)
    {
        return ContractSubunitDetail::create($data);
    }

    public function update($id, array $data)
    {
        $contract = $this->find($id);
        $contract->update($data);
        return $contract;
    }

    public function delete($id)
    {
        $area = $this->find($id);
        return $area->delete();
    }

    public function getCountOfSubunitType($detailId)
    {
        return ContractSubunitDetail::select('subunit_type', \DB::raw('count(*) as total'))
            ->where('contract_unit_detail_id', $detailId)      // your condition
            ->groupBy('subunit_type')        // group by the column
            ->get();
    }

    public function deleteLastNRows($cond1, $n)
    {
        return ContractSubunitDetail::where('status', $cond1)
            ->orderBy('created_at', 'desc')
            ->take($n)
            ->delete();
    }

    public function checkIfExist($data)
    {
        $existing = ContractSubunitDetail::withTrashed()
            ->where('contract_unit_detail_id', $data['detail_id'])
            ->where('subunit_no', $data['subunit_no'])
            ->first();

        if ($existing && $existing->trashed()) {
            // $existing->restore();
            return $existing;
        }
    }

    public function existPrevSubType($detailId, $is_partition)
    {
        if ($is_partition == '1') {
            $subunit_type = ['2', '3'];
        } else if ($is_partition == '2') {
            $subunit_type = ['1', '3'];
        } else {
            $subunit_type = ['1', '2'];
        }

        return ContractSubunitDetail::where('contract_unit_detail_id', $detailId)
            ->whereIn('subunit_type', $subunit_type)
            ->pluck('id')
            ->toArray();
    }
}
