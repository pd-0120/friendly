<?php

namespace App\Http\Controllers;

use App\Enums\RoleType;
use App\Models\Clocking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class ClockingController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $users = Clocking::query()->with('User');

            if(!auth()->user()->hasRole([RoleType::SuperAdmin])){
                $users  = $users->authUser();
            }

            if($request->input('columns.0.search.value')) {
                $users = $users->where('user_id', $request->input('columns.0.search.value'));
            }
            return DataTables::eloquent($users)
                ->addColumn('in_time', function ($data) {
                    return Carbon::parse($data->in_time)->format('H:i:s');
                })
                ->addColumn('out_time', function ($data) {
                    return $data->out_time ? Carbon::parse($data->out_time)->format('H:i:s') : '00:00:00';
                })
                ->addColumn('user', function ($data) {
                    return $data->User->name;
                })
                ->editColumn('action', function ($data) {
                    return view('formActions.clock-actions', compact('data'))->render();
                })
                ->make(true);
        }
        $users = User::get();

        return view("clockings.index", compact('users'));
    }

    public function create()
    {
        return view("clockings.create");

    }

    public function edit(Clocking $clocking)
    {
        return view("clockings.edit", compact('clocking'));
    }

    public function destroy(Clocking $clocking)
    {
        try {
            $clock = $clocking->delete();
            sleep(1);

            return response()->json([
                'status' => 'success',
                'message' => 'Clock deleted successfully',
                'data' => []
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
                'data' => []
            ], 200);
        }
    }
}
