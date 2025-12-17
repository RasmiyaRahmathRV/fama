<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    //
    public function index()
    {
        $title = 'Investments';
        return view("admin.investment.investment", compact("title"));
    }
}
