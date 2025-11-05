<?php

namespace App\Services\Contracts;

use App\Repositories\Contracts\OtcRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class OtcService
{
    public function __construct(
        protected OtcRepository $otcRepo,
    ) {}

    public function getAll()
    {
        return $this->otcRepo->all();
    }

    public function getById($id)
    {
        return $this->otcRepo->find($id);
    }

    public function create($contract_id, array $data, $user_id = null)
    {
        $this->validate($data);
        $data['contract_id'] = $contract_id;
        $data['added_by'] = $user_id ? $user_id : auth()->user()->id;

        return $this->otcRepo->create($data);
    }

    public function update(array $data, $user_id = null)
    {
        // dd($data);
        $id = $data['id'];
        $this->validate($data, $id);
        $data['updated_by'] = $user_id ? $user_id : auth()->user()->id;
        return $this->otcRepo->update($id, $data);
    }

    private function validate(array $data, $id = null)
    {
        $validator = Validator::make($data, [
            // 'cost_of_bed'
            // 'cost_of_matress'
            // 'appliances'
            // 'dewa_deposit'
            // 'cost_of_cabinets'
            // 'cost_of_development' => [
            //     'nullable',
            //     function ($attribute, $value, $fail) use ($data) {
            //         // Example: fetch the unit from DB (replace 'id' with your logic)
            //         $unitId = $data['contract_unit_id'] ?? null;
            //         $unit = ContractUnit::find($unitId);

            //         if ($unit && $unit->unit != 1 && empty($value)) {
            //             $fail('The unit number is required'); // because contract is not full building.
            //         }
            //     },
            // ],
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
