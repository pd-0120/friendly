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
