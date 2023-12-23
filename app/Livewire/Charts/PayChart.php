<?php

namespace App\Livewire\Charts;

use App\Enums\DateFilterEnum;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class PayChart extends Component
{
    public $users = [];
    public $dateFilterOptions = [];
    public $dateFilter = 0;
    public function mount() {
        $this->dateFilterOptions = DateFilterEnum::getAllProperties();
        $this->users = User::select('id', 'name')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.charts.pay-chart');
    }
}
