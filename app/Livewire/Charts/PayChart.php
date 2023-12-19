<?php

namespace App\Livewire\Charts;

use App\Enums\DateFilterEnum;
use App\Models\UserPay;
use Carbon\Carbon;
use Livewire\Component;

class PayChart extends Component
{
    public $paid = [];
    public $unpaid = [];
    public $label = [];
    public $users = [];

    public $fromDate;
    public $toDate;
    public $dateFilterOptions = [];
    public $dateFilter = 0;
    public function mount() {
        $this->dateFilterOptions = DateFilterEnum::getAllProperties();

        // Get data for weeks of the month
        $this->fromDate = Carbon::now()->subMonth()->startOfMonth();
        $this->toDate = $this->fromDate->copy()->addMonth()->endOfMonth();

        $this->thisMonth();
    }

    public function render()
    {
        return view('livewire.charts.pay-chart');
    }

    public function getUserPayInstace($week) : \Illuminate\Database\Eloquent\Builder {
        return UserPay::whereStartDate($week['from']);
    }

    public function filterData() {
        switch (str($this->dateFilter)->toInteger()) {
            case 0:
                $this->ththisMonthisMonth();
                break;
            case 1:
                $this->lastMonth();
                break;
            case 2:
                $this->lastThreeMonths();
                break;
            case 3:
                $this->lastSixMonths();
                break;
            case 4:
                $this->thisYear();
                break;
            case 5:
                $this->lastYear();
                break;
            default:
                $this->thisMonth();
                break;
        }

        $this->dispatch('post-created');

    }

    // Data filter

    public function thisMonth() {
        $weeks = weeksBetweenTwoDates($this->fromDate, $this->toDate);

        foreach ($weeks as $week) {
            $paid = $this->getUserPayInstace($week)->paid()->sum('net_pay');
            $unpaid = $this->getUserPayInstace($week)->unPaid()->sum('net_pay');

            array_push($this->paid, $paid);
            array_push($this->unpaid, $unpaid);
            array_push($this->label, $week['from'] . " - " . $week['to']);
        }
    }

    public function lastMonth()
    {
        $this->fromDate = Carbon::now()->subMonth()->startOfMonth();
        $this->toDate = $this->fromDate->copy()->endOfMonth();

        $weeks = weeksBetweenTwoDates($this->fromDate, $this->toDate);

        foreach ($weeks as $week) {
            $paid = $this->getUserPayInstace($week)->paid()->sum('net_pay');
            $unpaid = $this->getUserPayInstace($week)->unPaid()->sum('net_pay');

            array_push($this->paid, $paid);
            array_push($this->unpaid, $unpaid);
            array_push($this->label, $week['from'] . " - " . $week['to']);
        }
    }

    public function lastThreeMonths()
    {
        $this->fromDate = Carbon::now()->subMonths(3)->startOfMonth();
        $this->toDate = Carbon::now()->subMonth()->endOfMonth();

        $weeks = weeksBetweenTwoDates($this->fromDate, $this->toDate);

        foreach ($weeks as $week) {
            $paid = $this->getUserPayInstace($week)->paid()->sum('net_pay');
            $unpaid = $this->getUserPayInstace($week)->unPaid()->sum('net_pay');

            array_push($this->paid, $paid);
            array_push($this->unpaid, $unpaid);
            array_push($this->label, $week['from'] . " - " . $week['to']);
        }
    }

    public function lastSixMonths()
    {
        $weeks = weeksBetweenTwoDates($this->fromDate, $this->toDate);

        foreach ($weeks as $week) {
            $paid = $this->getUserPayInstace($week)->paid()->sum('net_pay');
            $unpaid = $this->getUserPayInstace($week)->unPaid()->sum('net_pay');

            array_push($this->paid, $paid);
            array_push($this->unpaid, $unpaid);
            array_push($this->label, $week['from'] . " - " . $week['to']);
        }
    }

    public function thisYear()
    {
        $weeks = weeksBetweenTwoDates($this->fromDate, $this->toDate);

        foreach ($weeks as $week) {
            $paid = $this->getUserPayInstace($week)->paid()->sum('net_pay');
            $unpaid = $this->getUserPayInstace($week)->unPaid()->sum('net_pay');

            array_push($this->paid, $paid);
            array_push($this->unpaid, $unpaid);
            array_push($this->label, $week['from'] . " - " . $week['to']);
        }
    }

    public function lastYear()
    {
        $weeks = weeksBetweenTwoDates($this->fromDate, $this->toDate);

        foreach ($weeks as $week) {
            $paid = $this->getUserPayInstace($week)->paid()->sum('net_pay');
            $unpaid = $this->getUserPayInstace($week)->unPaid()->sum('net_pay');

            array_push($this->paid, $paid);
            array_push($this->unpaid, $unpaid);
            array_push($this->label, $week['from'] . " - " . $week['to']);
        }
    }
}
