<?php

namespace Database\Seeders;

use App\Models\User;
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
            'password' => Hash::make('admin@friendly'),
            'email_verified_at' => now(),
        ];

        User::create($user);
    }
}
