<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request) {
        if($request->ajax()) {
            $users = User::query()->with('UserDetail');

            return DataTables::of($users)
            ->editColumn('action', function($data) {
                return view('formActions.user-actions', compact('data'))->render();
            })
            ->make(true);
        }
        return view('users.index');
    }

    public function create()
    {
        return view('users.create');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        try {

            DB::transaction(function() use($user) {
                $user->UserDetail ?? $user->UserDetail->delete();
            });

            sleep(1);

            return response()->json([
                'status' => 'success',
                'message' => 'User deleted successfully',
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
