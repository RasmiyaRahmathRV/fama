<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChequeClearingController extends Controller
{
    public function vendorChequeClearing()
    {
        return view('admin.finance.vendor-cheque-clearing');
    }
}
