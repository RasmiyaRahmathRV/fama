<?php

namespace App\Services\Investment;

use App\Repositories\Investment\InvestmentReceivedPaymentRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class InvestmentReceivedPaymentService
{
    public function __construct(
        protected InvestmentReceivedPaymentRepository $investmentReceivedPaymentRepository,
    ) {}


    public function getAll()
    {
        return $this->investmentReceivedPaymentRepository->all();
    }

    public function getById($id)
    {
        return $this->investmentReceivedPaymentRepository->find($id);
    }

    public function updateInitial($id, $data)
    {
        return $this->investmentReceivedPaymentRepository->updateInitial($id, $data);
    }

    public function create(array $data, $user_id = null)
    {
        $this->validate($data);
        $record = $this->investmentReceivedPaymentRepository->create($data);
        return $record;
    }

    public function update($id, array $data)
    {
        // $this->validate($data, $id);
        // $data['updated_by'] = auth()->user()->id;
        // return $this->$nvestmentReceivedPaymentRepository->update($id, $data);
    }

    // public function delete($id)
    // {
    //     return $this->investmentReceivedPaymentRepository->delete($id);
    // }



    private function validate(array $data, $id = null)
    {
        $validator = Validator::make($data, [
            'received_amount' => 'required|numeric|min:0',
            'received_date' => 'required|date',
        ], [
            'received_amount.required' => 'Received amount is required.',
            'received_amount.numeric' => 'Received amount must be a number.',
            'received_amount.min' => 'Received amount cannot be negative.',
            'received_date.required' => 'Received date is required.',
            'received_date.date' => 'Received date must be a valid date.',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
