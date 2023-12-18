<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserPay;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class PaySeeder extends Seeder
{
    public function run(): void
    {
        $fake = fake();

        $users = User::all();

        foreach($users as $user) {
            foreach(range(1,30) as $data) {
                $startDate = Carbon::today()->subDays(rand(0, 365))->startOfWeek();
                $endDate = $startDate->copy()->endOfWeek();

                $workingHours = fake()->numberBetween(15, 35);
                $pay = $workingHours*22;
                $payData = [
                    'user_id' => $user->id,
                    'net_pay' => $pay,
                    'gross_pay' => $pay,
                    'tax' => 0,
                    'tax_amount' => 0,
                    'rate' => 22,
                    'total_working_hours' => $workingHours,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'is_paid' => array_rand([0,1]),
                ];

                UserPay::create($payData);
            }
        }
    }
}
