<?php

namespace App\Http\Controllers;

use App\Models\UserPay;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserPayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $userPays = UserPay::query()->select('*');

            return DataTables::eloquent($userPays)
                ->editColumn('user_id', function($data) {
                    return $data->User->name ?? $data->User->name;
                })
                ->addColumn('pay_period', function ($data) {
                    return $data->PayPeriod();
                })
                ->editColumn('action', function ($data) {
                    return view('formActions.user-pay-actions', compact('data'))->render();
                })
                ->make(true);
        }

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
