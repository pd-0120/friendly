<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Scope a query to only include popular users.
     */
    public function scopeActiveClockIn(Builder $query): void
    {
        $query->where('date',now()->format('Y-m-d'))->whereNull('out_time');
    }

    public function scopeAuthUser(Builder $query): void {
        $query->where('user_id', auth()->user()->id);
    }

    public function markClockOut() {
        $diff = Carbon::now()->diffInMinutes($this->in_time);
        $diff = round($diff / 60,2, PHP_ROUND_HALF_EVEN);

        return $this->update([
            'out_time' => now()->format('Y-m-d H:i:s'),
            'out_agent' => get_user_agents(),
            'working_hours' => $diff
        ]);
    }
}
