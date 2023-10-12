<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserComponent extends Component
{

    public $name = "";
    public $email = "";
    public $detail_state = [
        'status' => true
    ];
    public $rules = [
        'name' => 'required',
        'email' => 'required|unique:users',
        'detail_state.phone' => 'required|max:20',
        'detail_state.dob' => 'nullable|date',
        'detail_state.emergency_phone' => 'nullable|max:20',
        'detail_state.street' => 'nullable|max:50',
        'detail_state.suburb' => 'nullable|max:50',
        'detail_state.pincode' => 'nullable|digits:4',
        'detail_state.payrate' => 'nullable|digits_between:1,50',
        'detail_state.joining_date' => 'nullable|date',
        'detail_state.leaving_date' => 'nullable|date',
        'detail_state.status' => 'boolean',
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

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = Hash::make(str()->random(8));
        $user->save();
        $userDetails = new UserDetails($this->detail_state);

        $user->UserDetail()->save($userDetails);
    }
}
