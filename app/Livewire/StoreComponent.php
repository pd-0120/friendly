<?php

namespace App\Livewire;

use App\Models\Store;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class StoreComponent extends Component
{
    public $state = [];

    public Store $store;

    public $rules = [
        'state.name' => 'required|max:20',
        'state.phone' => 'required|max:20',
        'state.emergency_phone' => 'required|max:20',
        'state.street' => 'required|max:50',
        'state.suburb' => 'required|max:50',
        'state.pincode' => "required|digits:4"
    ];

    public $validationAttributes = [
        'state.name' => "Name",
        'state.allowed_ips' => "Allowed IPs",
        'state.phone' => "Phone",
        'state.emergency_phone' => "Emergency Phone",
        'state.street' => "Streat",
        'state.suburb' => "SubUrb",
        'state.pincode' => "Pincode",
    ];

    public function render()
    {
        return view('livewire.store-component');
    }

    public function saveData() {
        $this->validate();

        if(!isset($this->store)) {
            $store = new Store($this->state);
            Session::flash('message.content', 'Store added successfully.');

        } else {
            $store = $this->store;
            Session::flash('message.content', 'Store updated successfully.');
        }
        $store->allowed_ips = json_encode(explode(',', $this->state['allowed_ips']));
        $store->save();

        Session::flash('message.level', 'success');

        return redirect()->route('store.index');
    }
}
