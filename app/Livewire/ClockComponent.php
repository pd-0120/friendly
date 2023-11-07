<?php

namespace App\Livewire;

use App\Models\Clocking;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class ClockComponent extends Component
{
    public $users;
    public $state = [];
    public $clock;

    public $rules = [
        "state.user_id"=> "required",
        "state.date" => "required",
        "state.in_time" => "required",
    ];

    public $validationAttributes = [
        "state.user_id" => "User",
        "state.date" => "Date",
        "state.in_time" => "In Time",
    ];

    public function mount() {
        $this->users = User::select('name', 'id')->get()->pluck('name', 'id');

        if($this->clock) {
            $this->state = $this->clock->toArray();
        }
    }

    public function saveData() {
        $this->validate();

        if ($this->clock) {
            $clock = $this->clock;
        } else {
            $clock = new Clocking();
            $clock->in_agent = get_user_agents();
        }
        if (isset($this->state['out_time'])) {
            $clock->out_agent = get_user_agents();
        }
        $clock->user_id     = $this->state['user_id'];

        if(isset($this->state['in_time'])) {
            $clock->in_time     = Carbon::parse($this->state['in_time']);
        }
        if (isset($this->state['out_time'])) {
            $clock->out_time    = Carbon::parse($this->state['out_time']);

            $diff = $clock->out_time->diffInMinutes($clock->in_time);
            $diff = round($diff / 60, 2, PHP_ROUND_HALF_EVEN);
            $clock->working_hours = $diff;

        }

        $clock->date        = $this->state['date'];
        $clock->save();
        dd($clock);
    }

    public function render()
    {
        return view('livewire.clock-component');
    }
}
