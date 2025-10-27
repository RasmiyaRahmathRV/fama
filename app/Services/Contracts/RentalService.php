<?php

namespace App\Services\Contracts;

use App\Repositories\Contracts\RentalRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RentalService
{
    public function __construct(
        protected RentalRepository $rentalRepo,
    ) {}

    public function getAll()
    {
        return $this->rentalRepo->all();
    }

    public function getById($id)
    {
        return $this->rentalRepo->find($id);
    }

    public function create($contract_id, array $data, $user_id = null)
    {
        $this->validate($data);
        $data['contract_id'] = $contract_id;
        $data['added_by'] = $user_id ? $user_id : auth()->user()->id;
        $data['contract_rental_code'] = $this->setRentalCode();

        return $this->rentalRepo->create($data);
    }

    public function setRentalCode($addval = 1)
    {
        $codeService = new \App\Services\CodeGeneratorService();
        return $codeService->generateNextCode('contract_rentals', 'contract_rental_code', 'VCR', 5, $addval);
    }

    private function validate(array $data, $id = null)
    {
        $validator = Validator::make($data, [
            "rent_per_annum_payable" => 'required',
            "total_payment_to_vendor" => 'required',
            "final_cost" => 'required',
            "initial_investment" => 'required',
            "rent_receivable_per_month" => 'required',
            "rent_receivable_per_annum" => 'required',
            "roi_perc" => 'required',
            "expected_profit" => 'required',
            "profit_percentage" => 'required',
            'receivable_installments' => 'required'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
