<?php

namespace App\Http\Controllers;

use App\Models\PayoutBatch;
use App\Services\BankService;
use App\Services\Investment\InvestorPaymentDistributionService;
use App\Services\Investment\InvestorService;
use App\Services\PaymentModeService;
use Illuminate\Http\Request;

class InvestorPaymentDistributionController extends Controller
{

    public function __construct(
        protected InvestorPaymentDistributionService $investorDistrService,
        protected PaymentModeService $paymentModeService,
        protected BankService $bankService,
        protected InvestorService $investorService,
    ) {}

    public function index()
    {
        $title = 'Investor';

        $banks = $this->bankService->getAll();
        $paymentmodes = $this->paymentModeService->getAll();
        $payoutbatches = PayoutBatch::where('status', 1)->get();
        $investors = $this->investorService->getAllActive();

        return view("admin.investment.investor-payment-distribution", compact("title", "paymentmodes", "banks", "payoutbatches", "investors"));
    }

    public function getPayouts(Request $request)
    {

        if ($request->ajax()) {
            $filterData = array(
                'month' => dateFormatChange($request->date_from, 'Y-m-d'),
                'batch_id' => dateFormatChange($request->date_to, 'Y-m-d'),
                'investor_id' => $request->investor_id,
            );

            $filters = [
                'search' => $request->search['value'] ?? null,
                'filter' => $filterData,
            ];

            return $this->investorDistrService->getPendingList($filters);
        }
    }
}
