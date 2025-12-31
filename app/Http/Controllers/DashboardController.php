<?php

namespace App\Http\Controllers;

use App\Services\Contracts\ContractService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        protected ContractService $contractServ,
    ) {}

    public function index()
    {
        $title = 'Dashboard';
        $renewalCount = $this->contractServ->getRenewalDataCount();
        return view('admin.dashboard', compact('title', 'renewalCount'));
    }
}
