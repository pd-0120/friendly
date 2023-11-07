<?php

namespace App\Http\Controllers;

use App\Enums\RoleType;
use App\Models\Clocking;
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

            return DataTables::of($users)
                ->addColumn('in_time', function ($data) {
                    return Carbon::parse($data->in_time)->format('H:i:s');
                })
                ->addColumn('out_time', function ($data) {
                    return $data->out_time ? Carbon::parse($data->out_time)->format('H:i:s') : '00:00:00';
                })
                ->addColumn('user', function ($data) {
                    return $data->User->name;
                })
                ->addColumn('date', function ($data) {
                    return $data->date;
                })
                ->editColumn('action', function ($data) {
                    return view('formActions.clock-actions', compact('data'))->render();
                })
                ->make(true);
        }
        return view("clockings.index");
    }

    public function create()
    {
        return view("clockings.create");

    }

    public function edit()
    {
        return view("clockings.edit");
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
