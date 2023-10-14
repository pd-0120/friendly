<?php

namespace Database\Seeders;

use App\Enums\RoleType;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            'name' => "Super Admin",
            'email' => "admin@friendly.com",
        ];

        $user = User::firstOrCreate($user, [
            'password' => Hash::make('admin@friendly'),
            'email_verified_at' => now(),]);

            if(!isset($user->UserDetail)) {
                $userDetail = new UserDetails();
                $user->UserDetail()->save($userDetail);
            }
            $user->assignRole(RoleType::SuperAdmin);
    }
}
