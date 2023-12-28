<?php

namespace Database\Seeders;

use App\Enums\RoleType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = RoleType::getAllProperties();

        $permissions = Permission::select('name')->get()->toArray();

        foreach($roles as $role) {
            $role = Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
            if($role->name == RoleType::SuperAdmin) {
                $role->syncPermissions($permissions);
            }
        }
    }
}
