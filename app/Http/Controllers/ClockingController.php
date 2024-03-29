<?php

namespace App\Http\Controllers;

use App\Enums\RoleType;
use App\Models\Clocking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

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
                ->editColumn('in_time', function ($data) {
                    return Carbon::parse($data->in_time)->format('H:i:s');
                })
                ->editColumn('in_agent', function ($data) {
                    return $data->in_agent ?  "<button class=' btn badge bg-primary clocking-data' data-type='in' data-id='$data->id'>$data->in_agent</button>" : "";
                })
                ->editColumn('out_time', function ($data) {
                    return $data->out_time ? Carbon::parse($data->out_time)->format('H:i:s') : '00:00:00';
                })
                ->editColumn('out_agent', function ($data) {
                    return $data->out_agent ? "<button class=' btn badge bg-primary clocking-data' data-type='out' data-id='$data->id'>$data->out_agent</button>" : "";
                })
                ->editColumn('user', function ($data) {
                    return $data->User->name;
                })
                ->editColumn('action', function ($data) {
                    return view('formActions.clock-actions', compact('data'))->render();
                })
                ->rawColumns([
                    'action',
                    'in_agent',
                    'out_agent',
                ])
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

    public function saveImageData(Request $request) {
        $data = explode(',', $request->image);
        $imageData = base64_decode($data[1]);

        $userId = Auth::user()->id;

        $path = "assets/images/clocking/$userId/";

        if(!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        $fileName = Uuid::uuid4().".png";
        $path = $path.$fileName;

        $dataSize = file_put_contents($path, $imageData);

        if($dataSize > 0 ) {
            return response()->json([
                'success' => true,
                'path' => $path
            ], 200);
        } else {
            return response()->json([
                'success' => false,
            ], 200);
        }
    }

    public function getClockingData(Request $request, Clocking $clocking, $type)
    {
        $data = "";
        if($type == "image") {
            $dataType = $request->dataType;
            if($dataType == "in") {
                $data = asset($clocking->clock_in_image);
            } else {
                $data = asset($clocking->clock_out_image);
            }

            $data = "<img src='$data' width='100%' height='auto'></img>";
        }

        return response()->json([
            'image' => $data,
            'type' => 'success'
        ], 200);
    }
}
