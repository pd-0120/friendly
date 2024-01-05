<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashDrop extends Model
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
        'is_last_drop',
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
