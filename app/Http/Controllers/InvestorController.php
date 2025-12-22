<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use App\Models\PaymentMode;
use App\Models\PayoutBatch;
use App\Services\Investment\InvestorService;
use App\Services\NationalityService;
use Illuminate\Http\Request;

class InvestorController extends Controller
{
    public function __construct(
        protected InvestorService $investorService,
        protected NationalityService $nationalityService,
    ) {}

    public function index()
    {
        $title = 'Investor';
        return view("admin.investment.investor", compact("title"));
    }

    public function create()
    {
        $title = 'Add Investor';
        $payoutbatches = PayoutBatch::where('status', 1)->get();
        $documentTypes = DocumentType::where('status', 2)->get();
        $nationalities = $this->nationalityService->getAll();
        $paymentModes = PaymentMode::all();
        $investors = $this->investorService->getAllActive();

        return view("admin.investment.investor-create", compact(
            "title",
            "payoutbatches",
            "nationalities",
            "documentTypes",
            "paymentModes",
            "investors"
        ));
    }

    public function store(Request $request)
    {
        try {
            if (!empty($request->id)) {
                $area = $this->investorService->update($request->id, $request->all());
                return response()->json(['success' => true, 'data' => $area, 'message' => 'Investor updated successfully'], 200);
            } else {
                $area = $this->investorService->create($request->all());

                return response()->json(['success' => true, 'data' => $area, 'message' => 'Investor created successfully'], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage(), 'error'   => $e], 500);
        }
    }

    public function getInvestors(Request $request)
    {
        if ($request->ajax()) {
            $filters = [
                'search' => $request->search['value'] ?? null
            ];
            return $this->investorService->getDataTable($filters);
        }
    }
}
