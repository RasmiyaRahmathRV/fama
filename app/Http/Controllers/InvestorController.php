<?php

namespace App\Http\Controllers;

use App\Exports\InvestorExport;
use App\Models\DocumentType;
use App\Models\PaymentMode;
use App\Models\PayoutBatch;
use App\Services\Investment\InvestorBankService;
use App\Services\Investment\InvestorService;
use App\Services\NationalityService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class InvestorController extends Controller
{
    public function __construct(
        protected InvestorService $investorService,
        protected InvestorBankService $investorBankSer,
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
        $investorsLists = $this->investorService->getAllActive();
        $investor = null;

        return view("admin.investment.investor-create", compact(
            "title",
            "payoutbatches",
            "nationalities",
            "documentTypes",
            "paymentModes",
            "investorsLists",
            "investor"
        ));
    }

    public function edit($id)
    {
        $title = 'Edit Investor';
        $payoutbatches = PayoutBatch::where('status', 1)->get();
        $documentTypes = DocumentType::where('status', 2)->get();
        $nationalities = $this->nationalityService->getAll();
        $paymentModes = PaymentMode::all();
        $investor = $this->investorService->getById($id);
        $investorsLists = $this->investorService->getAllActive();


        return view("admin.investment.investor-create", compact(
            "title",
            "payoutbatches",
            "nationalities",
            "documentTypes",
            "paymentModes",
            "investorsLists",
            "investor"
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

    public function update(Request $request, $id)
    {
        try {
            $investor = $this->investorService->update($id, $request->all());

            return response()->json(['success' => true, 'data' => $investor, 'message' => 'Investor updated successfully'], 200);
        } catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => $e->getMessage(), 'error'   => $e], 500);
        }
    }

    public function show($id)
    {
        $title = 'Investor Details';
        return view("admin.investment.view-investor", compact("title"));
    }

    public function addInvestorBank(Request $request)
    {
        try {
            $investor = $this->investorBankSer->create($request->all(), $request->investor_id);

            return response()->json(['success' => true, 'data' => $investor, 'message' => 'Investor bank created successfully'], 200);
        } catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => $e->getMessage(), 'error'   => $e], 500);
        }
    }

    public function exportInvestors()
    {

        $search = request('search') ?? null;

        return Excel::download(new InvestorExport($search), 'investors.xlsx');
    }
}
