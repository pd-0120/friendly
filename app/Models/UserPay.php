<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPay extends Model
{
    use HasFactory, HasUuids;

    public $fillable = [
        'user_id',
        'net_pay',
        'gross_pay',
        'tax',
        'tax_amount',
        'rate',
        'total_working_hours',
        'start_date',
        'end_date',
        'is_paid',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function PayPeriod() {
        return "$this->start_date - $this->end_date";
    }

    public function scopePaid(Builder $query): void
    {
        $query->where('is_paid', 1);
    }

    public function scopeUnPaid(Builder $query): void
    {
        $query->where('is_paid', 0);
    }
}
