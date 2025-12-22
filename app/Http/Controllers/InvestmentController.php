<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Repositories\Investment\InvestmentRepository;
use App\Services\Investment\InvestmentService;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    //
    public function __construct(
        protected InvestmentService $investmentService,
        protected InvestmentRepository $investmentRepository
    ) {}
    public function index()
    {
        $title = 'Investments';
        return view("admin.investment.investment", compact("title"));
    }
    public function create()
    {
        $title = 'Create Investment';
        $data = $this->investmentService->getFormData();
        $reinvestment = 0;
        $parent_investment_id = null;
        // dd($data);
        return view("admin.investment.create-investment", compact("title", "data", 'reinvestment', 'parent_investment_id'));
    }
    public function store(Request $request)
    {
        // dd($request);
        try {
            $investment = $this->investmentService->createOrRestore($request->all());
            return response()->json(['success' => true, 'data' => $investment, 'message' => 'Investment created successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage(), 'error'   => $e], 500);
        }
    }
    public function getInvestments(Request $request)
    {
        // dd("test");

        if ($request->ajax()) {
            $filters = [
                'company_id' => auth()->user()->company_id,
                'search' => $request->search['value'] ?? null
            ];
            return $this->investmentService->getDataTable($filters);
        }
    }
    public function addpendingInvestment(Request $request)
    {
        // $request->validate([
        //     'investment_id'   => 'required|exists:investments,id',
        //     'received_date'   => 'required|date',
        //     'received_amount' => 'required|numeric|min:0.01',
        // ]);

        try {
            $this->investmentService->submitPending($request->all());

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
    public function edit($id)
    {
        $title = 'Edit Investment';

        $investment = $this->investmentRepository->getWithDetails($id);

        // Get common form data
        $data = $this->investmentService->getFormData();

        return view("admin.investment.create-investment", compact("title", "data", "investment"));
    }
}
