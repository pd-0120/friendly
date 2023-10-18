<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory, HasUuids;

    public $fillable = [
        'name',
        'allowed_ips',
        'phone',
        'emergency_phone',
        'street',
        'suburb',
        'pincode',
    ];

    public function Stores()
    {
        return $this->belongsToMany(User::class, UserStores::class);
    }
}
