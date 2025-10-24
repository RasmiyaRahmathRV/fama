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
