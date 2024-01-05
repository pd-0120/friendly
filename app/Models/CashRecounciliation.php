<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class CashRecounciliation extends Model
{
    use HasFactory, HasUuids;

    public $fillable = [
        'd1',
        'd2',
        'd5',
        'd10',
        'd20',
        'd50',
        'd100',
        'd100',
        'c0.05',
        'c0.10',
        'c0.50',
        'date',
        'total',
        'created_by',
        'updated_by'
    ];

    public function CreatedBy()
    {
        return $this->belongsTo(User::class);
    }

    public function UpdatedBy()
    {
        return $this->belongsTo(User::class);
    }
}
