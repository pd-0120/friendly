<?php

namespace App\Console\Commands;

use App\Models\Clocking;
use App\Models\UserPay;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GeneratePayCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pay:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $startOfWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfWeek = Carbon::now()->subWeek()->endOfWeek();

        $userClockings = Clocking::select('*')
        ->whereBetween('date', [$startOfWeek, $endOfWeek])
        ->with('User.UserDetail')
        ->selectRaw('sum(working_hours) as total_working_hours, user_id')
        ->groupBy('user_id')
        ->get();

        if(count($userClockings) > 0) {
            foreach($userClockings as $userClocking) {

                if($userClocking->User && $userClocking->User->UserDetail) {

                    $totalPay = $this->calculateTotalPay($userClocking);

                    UserPay::create([
                        'user_id' => $userClocking->user_id,
                        'net_pay' => $totalPay,
                        'gross_pay' => $totalPay,
                        'tax' => 0,
                        'tax_amount' => 0,
                        'rate' => $userClocking->User->UserDetail->payrate,
                        'total_working_hours' => $userClocking->total_working_hours,
                        'start_date' => $startOfWeek,
                        'end_date' => $endOfWeek,
                        'is_paid' => false,
                    ]);
                }
            }
        }
    }

    public function calculateTotalPay($userClocking) {
        $total = 0;

        $total = $userClocking->total_working_hours*$userClocking->User->UserDetail->payrate;

        return $total;
    }
}
