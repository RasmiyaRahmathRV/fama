<?php

namespace App\Services\Investment;

use App\Models\Company;
use App\Models\Investor;
use App\Models\PayoutBatch;
use App\Models\ProfitInterval;
use App\Models\ReferralCommissionFrequency;
use App\Repositories\Investment\InvestmentRepository;
use App\Repositories\Investment\InvestmentSoaRepository;
use App\Repositories\Investment\InvestorRepository;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class InvestmentSoaService
{
    public function __construct(
        protected InvestmentRepository $investmentRepository,
        protected InvestorRepository $investorRepository,
        protected InvestmentRepository $investmentReferralRepository,
        protected InvestmentDocumentService $investmentDocumentService,
        protected InvestmentSoaRepository $investmentSoaRepository,

    ) {}

    public function getDataTable(array $filters = [])
    {

        $rows = $this->investmentSoaRepository->getQuery($filters);
        $columns = [
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex'],
            ['data' => 'date', 'name' => 'date'],
            ['data' => 'account_name', 'name' => 'account_name'],
            ['data' => 'investor_name', 'name' => 'investor_name'],
            ['data' => 'credit', 'name' => 'credit'],
            ['data' => 'debit', 'name' => 'debit'],
        ];

        return datatables()
            ->collection($rows)
            ->addIndexColumn()
            ->editColumn('date', function ($row) {
                return \Carbon\Carbon::parse($row['date'])->format('d-m-Y');
            })
            ->editColumn('account_name', fn($row) => $row['account_name'])
            ->editColumn('investor_name', fn($row) => $row['investor_name'])
            ->editColumn('credit', fn($row) => (float) $row['credit'], 2)
            ->editColumn('debit', fn($row) => (float) $row['debit'], 2)
            ->rawColumns(['date', 'account_name', 'investor_name', 'credit', 'debit'])
            ->with(['columns' => $columns])
            ->toJson();
    }
}
