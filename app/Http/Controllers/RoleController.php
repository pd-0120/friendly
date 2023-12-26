<?php

namespace App\Http\Controllers;

use App\Enums\RoleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $preDefineRoles = RoleType::getAllProperties();
        if($request->ajax()) {
            $rolesData = Role::query();

            return DataTables::eloquent($rolesData)
            ->editColumn('action', function($data) use ($preDefineRoles){
                return view('formActions.role-actions', compact('data', 'preDefineRoles'))->render();
            })->make(true);
        }

        return view('role.index');
    }

    public function create()
    {
        return view('role.create');
    }

    public function edit(Role $role)
    {
        return view('role.edit', compact('role'));
    }

    public function destroy(Role $role)
    {
        $role->delete();

        try {

            sleep(1);

            return response()->json([
                'status' => 'success',
                'message' => 'Role deleted successfully',
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
