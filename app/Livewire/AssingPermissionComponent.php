<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;


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
        dd($this);
    }
}
