<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Livewire\Attributes\Computed;


class AssingPermissionComponent extends Component
{
    public $role;
    public $roleHasPermissions = [];

    #[Computed]
    public function permissions() {
        return Permission::select('name', 'module', 'description')->get()->groupBy('module');
    }
    public function mount() {

        $this->role->getAllPermissions()->filter(function($data){
            array_push($this->roleHasPermissions, $data->name);
        });
    }
    public function render()
    {
        return view('livewire.assing-permission-component');
    }

    public function saveData() {

    }
}
