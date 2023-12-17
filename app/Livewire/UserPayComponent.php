<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\UserPay;
use Livewire\Component;

class UserPayComponent extends Component
{
    public UserPay $pay;

    public $state = [];
    public $users;

    public $rules = [
        'state.net_pay' => 'required|integer',
        'state.notes' => 'nullable|max:200',
    ];

    public function mount() {
        if(isset($this->pay)) {
            $this->state = $this->pay->toArray();
            $this->state['user'] = $this->pay->User->name;
        } else {
            $this->users = User::all();
        }
    }
    public function render()
    {
        return view('livewire.user-pay-component');
    }

    public function saveData() {

    }
}
