<?php
use Carbon\CarbonPeriod;
use Jenssegers\Agent\Agent;

if(!function_exists('get_user_agents')) {
    function get_user_agents() {
        $agent = new Agent();

        $platform   = $agent->platform();
        $browser    = $agent->browser();
        $deviceType = $agent->deviceType();

        return "$platform $browser $deviceType";
    }
}

if(!function_exists('weeksBetweenTwoDates')) {
    function weeksBetweenTwoDates($start, $end)
    {
        $weeks = [];

        while ($start->weekOfYear !== $end->weekOfYear) {
            $weeks[] = [
                'from' => $start->startOfWeek()->format('Y-m-d'),
                'to' => $start->endOfWeek()->format('Y-m-d'),
            ];

            $start->addWeek(1);
        }

        return $weeks;
    }
}

if (!function_exists('fortNightBetweenTwoDates')) {
    function fortNightBetweenTwoDates($start, $end)
    {

        $weeks = [];

        while ($start->weekOfYear <= $end->weekOfYear) {
            $weeks[] = [
                'from' => $start->startOfWeek()->format('Y-m-d'),
                'to' => $start->copy()->addWeek(1)->endOfWeek()->format('Y-m-d'),
                'isDateBetween' => 1,
            ];

            $start->addWeek(2);
        }

        return $weeks;
    }
}

if (!function_exists('monthsBetweenTwoDates')) {
    function monthsBetweenTwoDates($start, $end)
    {
        $period = CarbonPeriod::since($start)->month()->until($end);
        $month = [];

        foreach($period as $p) {
            $month[] = [
                'from' => $p->startOfMonth()->format('Y-m-d'),
                'to' => $p->copy()->endOfMonth()->format('Y-m-d'),
                'month' => $p->copy()->format("M"),
                'isDateBetween' => 1
            ];
        }

        return $month;
    }
}
