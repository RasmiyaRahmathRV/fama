<?php

namespace App\Services\Investment;

use App\Repositories\Investment\InvestorPaymentDistributionRepository;
use App\Repositories\Investment\InvestorRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class InvestorPaymentDistributionService
{
    public function __construct(
        protected InvestorPaymentDistributionRepository $investorDistRepo,
    ) {}


    public function getAll()
    {
        return $this->investorDistRepo->all();
    }

    public function getById($id)
    {
        return $this->investorDistRepo->find($id);
    }

    // public function getByName($name)
    // {
    //     return $this->investorDistRepo->getByName($name);
    // }

    public function create(array $data, $user_id = null)
    {
        $this->validate($data);

        $record = $this->investorDistRepo->create($data);
        return $record;
    }

    public function update($id, array $data)
    {
        $this->validate($data, $id);
        $data['updated_by'] = auth()->user()->id;
        return $this->investorDistRepo->update($id, $data);
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

    public function getPendingList(array $filters = [])
    {
        $query = $this->investorDistRepo->getPendings($filters);

        $columns = [
            ['data' => 'checkbox', 'name' => 'checkbox'],
            ['data' => 'investor_name', 'name' => 'investor.investor_name'],
            ['data' => 'payout_date', 'name' => 'payout_date'],
            ['data' => 'payout_type', 'name' => 'payout_type'],
            ['data' => 'payout_amount', 'name' => 'amount_pending'],
            ['data' => 'payment_mode', 'name' => 'payment_mode'],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false],
        ];

        return datatables()
            ->of($query)
            ->addColumn('checkbox', function ($row) {
                return '<div class="icheck-primary d-inline">
                            <input type="checkbox" id="ichek' . $row->id . '" class="groupCheckbox"
                                name="investor_payout_id[' . $row->id . ']" value="' . $row->id . '">
                            <label for="ichek' . $row->id . '">
                            </label>
                        </div>';
            })

            ->addColumn('investor_name', function ($row) {
                $investor = $row->investor;

                if (!$investor) return '-';

                return "
            <strong class='text-capitalize'>{$investor->investor_name}</strong>
            <p class='mb-0 text-primary'>{$investor->investor_email}</p>
            <p class='text-muted small'>
                <i class='fa fa-phone-alt text-danger'></i>
                <span class='font-weight-bold'>{$investor->investor_mobile}</span>
            </p>
        ";
            })

            ->addColumn('payout_date', function ($row) {
                return getPayoutDate($row);
            })

            ->addColumn('payout_type', function ($row) {
                return match ($row->payout_type) {
                    1 => '<span class="badge badge-success">Profit</span>',
                    2 => '<span class="badge badge-info">Commission</span>',
                    3 => '<span class="badge badge-warning">Principal</span>',
                    default => '-',
                };
            })

            ->addColumn('payout_amount', function ($row) {
                return number_format($row->amount_pending, 2);
            })

            ->addColumn('payment_mode', function ($row) {
                $investor = $row->investor;

                if (!$investor || !$investor->paymentMode) return '-';

                if (in_array($investor->paymentMode->id, [1, 4])) {
                    return $investor->paymentMode->payment_mode_name;
                }

                if ($investor->paymentMode->id == 2) {
                    $bankName = $investor->primaryBank->investor_bank_name ?? '-';
                    return $investor->paymentMode->payment_mode_name . ' - ' . $bankName;
                }

                return '-';
            })

            ->addColumn('action', function ($row) {
                return '
                <a class="btn btn-success btn-sm" title="Clear cheque"
                                data-toggle="modal" data-target="#modal-clear-payable"
                                data-clear-type="single" data-det-id="' . $row->id . '" 
                                data-amount="' . $row->amount_pending . '">
                                Pay now</a>';
            })

            ->rawColumns(['investor_name', 'payout_type', 'action', 'checkbox'])
            ->with(['columns' => $columns])
            ->toJson();
    }
}
