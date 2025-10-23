<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgreementController extends Controller
{
    //
    public function index()
    {
        return view('admin.projects.agreement.agreement');
    }
    public function create()
    {
        return view('admin.projects.agreement.create-agreement');
    }
}
