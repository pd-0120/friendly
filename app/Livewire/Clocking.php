<?php

namespace App\Livewire;

use App\Models\Clocking as ModelsClocking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\On;


class Clocking extends Component
{
    public $isClockedIn = false;
    public $clockedDateTime;
    public ModelsClocking $clock;

    public $clockInTime;
    public $inTime = "00:00:00";
    public $clockingImage = "";

    public $intervalId = 0;
    public function mount()
    {
        $clock = ModelsClocking::authUser()->activeClockIn()->first();
        if($clock) {
            $this->clock = $clock;
            $this->isClockedIn = true;
            $this->clockInTime = $clock->in_time;

            $this->inTime = Carbon::now()->diff($this->clockInTime)->format("%H:%I:%S");
            $this->clockedDateTime = Carbon::createFromFormat('H:i:s', $this->inTime);
        }
    }

    public function render()
    {
        return view('livewire.clocking');
    }

    #[On('image-saved')]
    public function saveClocking($refreshPosts) {
        if($refreshPosts) {
            $this->clockingImage = $refreshPosts;

            $this->isClockedIn ? $this->clockOut() : $this->clockIn();
        }
        return "";
    }

    public function clockIn() {
        $user = Auth::user();
        $data = [
            'user_id' => $user->id,
            'date' => now()->format('Y-m-d'),
            'in_time' => now()->format('Y-m-d H:i:s'),
            'in_agent' => get_user_agents(),
            'clock_in_image' => $this->clockingImage,
        ];

        $clocking = ModelsClocking::create($data);
        if($clocking) {
            $this->isClockedIn = true;
            $this->clock = $clocking;
            $this->clockedDateTime = Carbon::now()->startOfDay();
            $this->dispatch('clocking-in')->self();
        }
        $this->clockingImage = "";
    }

    public function clockOut() {

        DB::transaction(function() {
            $diff = Carbon::now()->diffInMinutes($this->clock->in_time);
            $diff = round($diff / 60, 2, PHP_ROUND_HALF_EVEN);

            $markedClockOut = $this->clock->update([
                'out_time' => now()->format('Y-m-d H:i:s'),
                'out_agent' => get_user_agents(),
                'working_hours' => $diff,
                'clock_out_image' => $this->clockingImage,
            ]);

            if($markedClockOut) {
                $this->isClockedIn = false;
                $this->inTime = "00:00:00";
                $this->dispatch('clocking-done')->self();
            }

            $this->clockingImage = "";
        });
    }
}
