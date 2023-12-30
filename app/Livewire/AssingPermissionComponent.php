<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Session;

class AssingPermissionComponent extends Component
{
    public $role;
    public $roleHasPermissions = [];

    public $permissions;
    public $state = [];
    public function mount() {

        $this->role->getAllPermissions()->filter(function($data){
            array_push($this->roleHasPermissions, $data->name);
        });
        $this->permissions = Permission::select('name', 'module', 'description')->get()->groupBy('module')->toArray();

        $this->buildPermissionState();
    }
    public function render()
    {
        return view('livewire.assing-permission-component');
    }

    public function buildPermissionState() {
        foreach ($this->permissions as $permissionModules) {
            foreach ($permissionModules as $permission) {
                if (in_array($permission['name'], $this->roleHasPermissions)) {
                    $this->state[$permission['name']] = true;
                } else {
                    $this->state[$permission['name']] = false;
                }
            }
        }
    }
    public function saveData() {
        $permissions = collect($this->state)->filter(function($data) {
            return $data;
        })
        ->keys()
        ->toArray();
        $this->role->syncPermissions($permissions);

        Session::flash('message.level', 'success');
        Session::flash('message.content', 'Permissions updated successfully.');
        return redirect()->route('role.index');
    }
}
