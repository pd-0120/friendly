<?php

namespace App\Livewire;

use App\Models\Store;
use Livewire\Component;

class StoreComponent extends Component
{
    public $state = [];

    public Store $store;

    public $rules = [
        'name' => 'required|max:',
        'allowed_ips' => 'nullable',
        'phone' => 'nullable|max:20',
        'emergency_phone' => 'nullable|max:20',
        'street' => 'nullable|max:50',
        'suburb' => 'nullable|max:50',
        'pincode' => "nullable|max:50"
    ];

    public $validationAttributes = [
        'store.name' => "Name",
        'store.allowed_ips' => "Allowed IPs",
        'store.phone' => "",
        'store.emergency_phone' => "Emergency Phone",
        'store.street' => "Streey",
        'store.suburb' => "SubUrb",
        'store.pincode' => "Pincode",
    ];

    public function render()
    {
        return view('livewire.store-component');
    }
}
