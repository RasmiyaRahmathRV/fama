<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ContractRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        protected ContractRepository $contractRepo,
    ) {}


    public function index()
    {
        $title = 'Dashboard';
        $renewalCount = $this->contractRepo->getRenewalQuery()->count();
        return view('admin.dashboard', compact('title', 'renewalCount'));
    }
}
