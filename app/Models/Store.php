<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected function allowedIps() :Attribute {
        return Attribute::make(
            get: fn(string|null $value) => isset($value) ? json_decode($value) : null,
            set: fn(array|null $value) => isset($value) ? json_encode($value) : null
        );
    }
}
