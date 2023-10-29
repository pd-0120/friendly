<?php

namespace App\Livewire;

use App\Models\Clocking as ModelsClocking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Clocking extends Component
{
    public $isClockedIn = false;
    public ModelsClocking $clock;

    public $clockInTime;
    public $inTime = "00:00:00";

    public function mount()
    {
        $clock = ModelsClocking::authUser()->activeClockIn()->first();
        if($clock) {
            $this->clock = $clock;
            $this->isClockedIn = true;
            $this->clockInTime = $clock->in_time;

            $this->inTime = Carbon::now()->diff($this->clockInTime)->format("%H:%I:%S");
        }
    }

    public function render()
    {
        return view('livewire.clocking');
    }

    public function clockIn() {
        $user = Auth::user();
        $data = [
            'user_id' => $user->id,
            'date' => now()->format('Y-m-d'),
            'in_time' => now()->format('Y-m-d H:i:s'),
            'in_agent' => get_user_agents(),
        ];

        $clocking = ModelsClocking::create($data);
        if($clocking) {
            $this->isClockedIn = true;
            $this->clock = $clocking;
        }
    }

    public function clockOut() {
        DB::transaction(function() {
            $markedClockOut = $this->clock->markClockOut();
            if($markedClockOut) {
                $this->isClockedIn = false;
                $this->inTime = "00:00:00";
            }
        });
    }
}
