<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Session;

class RoleComponent extends Component
{
    public $role;

    public $name;

    public $rules = [
        'name' => 'required:30'
    ];

    public function mount() {
        if($this->role) {
            $this->name = $this->role->name;
        }
    }
    public function render()
    {
        return view('livewire.role-component');
    }

    public function saveData() {
        $this->validate();

        if ($this->role) {
            $role = $this->role;
            Session::flash('message.content', 'Role updated successfully.');
        } else {
            $role = new Role();
            $role->guard_name = "web";
            Session::flash('message.content', 'Role added successfully.');
        }

        $role->name = $this->name;
        $role->save();;

        Session::flash('message.level', 'success');
        return redirect()->route('role.index');
    }
}
