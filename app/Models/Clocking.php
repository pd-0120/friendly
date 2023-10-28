<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clocking extends Model
{
    use HasFactory, HasUuids;

    public $fillable = [
        'user_id',
        'date',
        'in_time',
        'out_time',
        'working_hours',
        'in_agent',
        'out_agent',
        'notes',
    ];

    public function User() {
        return $this->belongsTo(User::class);
    }
}
