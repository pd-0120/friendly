<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CashRecounciliation;

class CashRecounciliationController extends Controller
{
    public function index(Request $request)
    {
        return view('cash-management.recounciliation.index');
    }

    public function create()
    {
        return view('cash-management.recounciliation.create');
    }

    public function edit(CashRecounciliation $cashRecounciliation)
    {
        return view('cash-management.recounciliation.edit');
    }
}
