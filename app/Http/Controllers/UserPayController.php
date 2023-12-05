<?php

namespace App\Http\Controllers;

use App\Models\UserPay;
use Illuminate\Http\Request;

class UserPayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('pays.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pays.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserPay $userPay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserPay $userPay)
    {
        return view('pays.edit');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserPay $userPay)
    {
        dd($userPay);
    }
}
