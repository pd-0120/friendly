<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\UserPay;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public $paid = [];
    public $unpaid = [];
    public $label = [];
    public $fromDate;
    public $toDate;
    public $dateFilter;
    public $employeeFilter;
    public function userPayBarChart(Request $request)
    {
        // Get data for weeks of the month
        $this->fromDate = Carbon::now()->startOfMonth();
        $this->toDate = $this->fromDate->copy()->endOfMonth();

        $this->dateFilter = $request->dateFilter;

        if($request->employeeFilter) {
            $this->employeeFilter = $request->employeeFilter;
        }

        switch (str($this->dateFilter)->toInteger()) {
            case 0:
                $this->thisMonth();
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

        return [
            'paid' => $this->paid,
            'unpaid' => $this->unpaid,
            'categories' => $this->label,
        ];
    }

    public function getUserPayInstace($week): \Illuminate\Database\Eloquent\Builder
    {
        if(isset($week['isDateBetween'])) {
            $instance = UserPay::whereDate('start_date', ">=", date($week['from']))
            ->whereDate('start_date', "<=", date($week['to']));
        } else {
            $instance = UserPay::whereStartDate($week['from']);
        }

        if($this->employeeFilter) {
            $instance = $instance->whereUserId($this->employeeFilter);
        }

        return $instance;
    }

    public function thisMonth()
    {
        $weeks = weeksBetweenTwoDates($this->fromDate, $this->toDate);
        $this->setWeekData($weeks);
    }

    public function lastMonth()
    {
        $this->fromDate = Carbon::now()->subMonth()->startOfMonth();
        $this->toDate = $this->fromDate->copy()->endOfMonth();

        $weeks = weeksBetweenTwoDates($this->fromDate, $this->toDate);
        $this->setWeekData($weeks);
    }

    public function lastThreeMonths()
    {
        $this->fromDate = Carbon::now()->subMonths(3)->startOfMonth();
        $this->toDate = Carbon::now()->subMonth()->endOfMonth();

        $weeks = fortNightBetweenTwoDates($this->fromDate, $this->toDate);
        $this->setWeekData($weeks);
    }

    public function lastSixMonths()
    {
        $this->fromDate = Carbon::now()->subMonths(6)->startOfMonth();
        $this->toDate = Carbon::now()->subMonth()->endOfMonth();

        $weeks = fortNightBetweenTwoDates($this->fromDate, $this->toDate);
        $this->setWeekData($weeks);
    }

    public function thisYear()
    {
        $this->fromDate = Carbon::now()->startOfYear();
        $this->toDate = Carbon::now()->endOfYear();

        $this->setYearData();
    }

    public function lastYear()
    {
        $this->fromDate = Carbon::now()->subYear()->startOfYear();
        $this->toDate = $this->fromDate->copy()->endOfYear();

        $this->setYearData();
    }

    private function setWeekData($weeks) {
        foreach ($weeks as $week) {
            $paid = $this->getUserPayInstace($week)->paid()->sum('net_pay');
            $unpaid = $this->getUserPayInstace($week)->unPaid()->sum('net_pay');

            array_push($this->paid, $paid);
            array_push($this->unpaid, $unpaid);
            array_push($this->label, $week['from'] . " - " . $week['to']);
        }
    }
    private function setYearData() {
        $months = monthsBetweenTwoDates($this->fromDate, $this->toDate);

        foreach ($months as $month) {
            $paid = $this->getUserPayInstace($month)->paid()->sum('net_pay');
            $unpaid = $this->getUserPayInstace($month)->unPaid()->sum('net_pay');

            array_push($this->paid, $paid);
            array_push($this->unpaid, $unpaid);
            array_push($this->label, $month['month']);
        }
    }
}
