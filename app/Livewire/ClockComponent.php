<?php

namespace App\Livewire;

use App\Models\Clocking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ClockComponent extends Component
{
    public $users;
    public $state = [];
    public $clocking;

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

        if($this->clocking) {
            $this->state = $this->clocking->toArray();

            if($this->clocking->in_time) {
                $this->setTimeInState('in_time', $this->clocking->in_time);
            }

            if ($this->clocking->out_time) {
                $this->setTimeInState('out_time', $this->clocking->out_time);
            }
        }
    }

    public function saveData() {
        $this->validate();

        if ($this->clocking) {
            $clock = $this->clocking;
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
        Session::flash('message.level', 'success');
        Session::flash('message.content', 'Clock added successfully.');

        return redirect()->route('clocking.index');
    }

    public function render()
    {
        return view('livewire.clock-component');
    }

    private function setTimeInState($type, $time) {
        $this->state[$type] = Carbon::parse($time)->toTimeString();
    }
}
