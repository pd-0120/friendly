<?php
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
                'to' => $start->endOfWeek()->format('Y-m-d')
            ];

            $start->addWeek(1);
        }

        return $weeks;
    }
}
