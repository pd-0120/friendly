<?php

namespace App\Livewire;

use Livewire\Component;

class UserComponent extends Component
{

    public $name = "";
    public $email = "";
    public $detail_state = [
        'active' => true
    ];
    public $rules = [
        'name' => 'required',
        'email' => 'required|unique:users',
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

    public $validationAttributes = [
        'detail_state.phone' => 'phone',
        'detail_state.dob' => 'date of birth',
        'detail_state.emergency_phone' => 'emergency phone',
        'detail_state.street' => 'street',
        'detail_state.suburb' => 'suburb',
        'detail_state.pincode' => 'pincode',
        'detail_state.payrate' => 'payrate',
        'detail_state.joining_date' => 'joining date',
        'detail_state.leaving_date' => 'leaving date',
        'detail_state.status' => 'status',
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
