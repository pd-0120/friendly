<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory, HasUuids;

    public $fillable = [
        'user_id',
        'phone',
        'emergency_phone',
        'street',
        'suburb',
        'pincode',
        'payrate',
        'joining_date',
        'leaving_date',
        'dob',
        'status'
    ];

    public function User() {
        return $this->belongsTo(User::class);
    }
}
