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
                ->editColumn('is_paid', function ($data) {
                    return view('formActions.user-pay-status', compact('data'))->render();
                })
                ->editColumn('action', function ($data) {
                    return view('formActions.user-pay-actions', compact('data'))->render();
                })
                ->rawColumns(['is_paid', 'action'])
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

    public function upatePayStatus($userPay)
    {
        $userPayData = UserPay::find($userPay);
        $userPayData->is_paid = !$userPayData->is_paid;
        $userPayData->save();

        return $userPayData;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserPay $pay)
    {
        return view('pays.edit', compact('pay'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserPay $userPay)
    {
        dd($userPay);
    }
}
