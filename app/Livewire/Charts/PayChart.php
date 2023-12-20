<?php

namespace App\Livewire\Charts;

use App\Enums\DateFilterEnum;
use App\Models\UserPay;
use Carbon\Carbon;
use Livewire\Component;

class PayChart extends Component
{
    public $users = [];
    public $dateFilterOptions = [];
    public $dateFilter = 0;
    public function mount() {
        $this->dateFilterOptions = DateFilterEnum::getAllProperties();
    }

    public function render()
    {
        return view('livewire.charts.pay-chart');
    }
}
