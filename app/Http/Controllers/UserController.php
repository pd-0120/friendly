<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request) {
        if($request->ajax()) {
            $users = User::query()->with('UserDetail');

            return DataTables::of($users)
            ->editColumn('action', function($data)  {
                return $data->name;
            })
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
}
