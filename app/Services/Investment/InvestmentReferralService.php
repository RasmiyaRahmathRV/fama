<?php

namespace App\Services\Investment;

use App\Repositories\Investment\InvestmentReferralRepository;
use App\Repositories\Investment\InvestorRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class InvestmentReferralService
{
    public function __construct(
        protected InvestmentReferralRepository $investmentReferralRepository,
    ) {}


    public function getAll()
    {
        return $this->investmentReferralRepository->all();
    }

    public function getById($id)
    {
        return $this->investmentReferralRepository->find($id);
    }

    // public function getByName($name)
    // {
    //     return $this->investmentReferralRepository->getByName($name);
    // }

    public function create(array $data, $user_id = null)
    {
        $this->validate($data);

        $record = $this->investmentReferralRepository->create($data);
        return $record;
    }

    public function update($id, array $data)
    {
        $this->validate($data, $id);
        $data['updated_by'] = auth()->user()->id;
        return $this->investmentReferralRepository->update($id, $data);
    }





    private function validate(array $data, $id = null)
    {
        $validator = Validator::make($data, [

            'referral_commission_perc' => 'required|numeric|min:0|max:100',
            'referral_commission_amount' => 'required|numeric|min:0',
            'referral_commission_frequency_id' => 'required|exists:referral_commission_frequencies,id',
        ], [

            'referral_commission_perc.required' => 'Referral commission percentage is required.',
            'referral_commission_perc.numeric' => 'Referral commission percentage must be a number.',
            'referral_commission_perc.min' => 'Referral commission percentage cannot be negative.',
            'referral_commission_perc.max' => 'Referral commission percentage cannot exceed 100.',
            'referral_commission_amount.required' => 'Referral commission amount is required.',
            'referral_commission_amount.numeric' => 'Referral commission amount must be a number.',
            'referral_commission_amount.min' => 'Referral commission amount cannot be negative.',

        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
