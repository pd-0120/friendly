<?php

namespace App\Livewire;

use Livewire\Component;

class UserComponent extends Component
{
    public $state = [];
    public $detail_state = [
        'active' => true
    ];
    public $rules = [
        'state.name' => 'required',
        'state.email' => 'required|unique:users',
        'detail_state.phone' => 'required|max:50',
        'detail_state.dob' => 'nullable|date',
        'detail_state.emergency_phone' => 'nullable|max:50',
        'detail_state.street' => 'nullable|max:50',
        'detail_state.suburb' => 'nullable|max:50',
        'detail_state.pincode' => 'nullable|digit|max:50',
        'detail_state.payrate' => 'nullable|digit|max:50',
        'detail_state.joining_date' => 'nullable|date',
        'detail_state.leaving_date' => 'nullable|date',
        'detail_state.status' => 'rquired|boolean',
    ];

    public function render()
    {
        return view('livewire.user-component');
    }

    public function save() {
        $this->validate();
        dd($this);
    }
}
