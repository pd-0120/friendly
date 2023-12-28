<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [];

        $usersPermissions = [
            [
                'name' => 'add_user',
                'guard_name' => 'web',
                'description' => 'Add Users',
                'module' => 'user',
                'route' => 'user.create',
            ], [
                'name' => 'view_users',
                'guard_name' => 'web',
                'description' => 'View Users',
                'module' => 'user',
                'route' => 'user.index',
            ], [
                'name' => 'edit_user',
                'guard_name' => 'web',
                'description' => 'Edit Users',
                'module' => 'user',
                'route' => 'user.edit',
            ], [
                'name' => 'delete_user',
                'guard_name' => 'web',
                'description' => 'Delete Users',
                'module' => 'user',
                'route' => 'user.delete',
            ]
        ];

        $storesPermissions = [
            [
                'name' => 'add_store',
                'guard_name' => 'web',
                'description' => 'Add stores',
                'module' => 'store',
                'route' => 'store.create',
            ], [
                'name' => 'view_store',
                'guard_name' => 'web',
                'description' => 'View stores',
                'module' => 'store',
                'route' => 'store.index',
            ], [
                'name' => 'edit_store',
                'guard_name' => 'web',
                'description' => 'Edit stores',
                'module' => 'store',
                'route' => 'store.edit',
            ], [
                'name' => 'delete_store',
                'guard_name' => 'web',
                'description' => 'Delete stores',
                'module' => 'store',
                'route' => 'store.delete',
            ]
        ];

        $payPermissions = [
            [
                'name' => 'add_pay',
                'guard_name' => 'web',
                'description' => 'Add pays',
                'module' => 'pay',
                'route' => 'pay.create',
            ], [
                'name' => 'view_pay',
                'guard_name' => 'web',
                'description' => 'View pays',
                'module' => 'pay',
                'route' => 'pay.index',
            ], [
                'name' => 'edit_pay',
                'guard_name' => 'web',
                'description' => 'Edit pays',
                'module' => 'pay',
                'route' => 'pay.edit',
            ], [
                'name' => 'delete_pay',
                'guard_name' => 'web',
                'description' => 'Delete pays',
                'module' => 'pay',
                'route' => 'pay.delete',
            ]
        ];

        $clockingPermissions = [
            [
                'name' => 'add_clocking',
                'guard_name' => 'web',
                'description' => 'Add clockings',
                'module' => 'clocking',
                'route' => 'clocking.create',
            ], [
                'name' => 'view_clocking',
                'guard_name' => 'web',
                'description' => 'View clockings',
                'module' => 'clocking',
                'route' => 'clocking.index',
            ], [
                'name' => 'edit_clocking',
                'guard_name' => 'web',
                'description' => 'Edit clockings',
                'module' => 'clocking',
                'route' => 'clocking.edit',
            ], [
                'name' => 'delete_clocking',
                'guard_name' => 'web',
                'description' => 'Delete clockings',
                'module' => 'clocking',
                'route' => 'clocking.delete',
            ]
        ];

        $rolePermissions = [
            [
                'name' => 'add_role',
                'guard_name' => 'web',
                'description' => 'Add roles',
                'module' => 'role',
                'route' => 'role.create',
            ], [
                'name' => 'view_role',
                'guard_name' => 'web',
                'description' => 'View roles',
                'module' => 'role',
                'route' => 'role.index',
            ], [
                'name' => 'edit_role',
                'guard_name' => 'web',
                'description' => 'Edit roles',
                'module' => 'role',
                'route' => 'role.edit',
            ], [
                'name' => 'delete_role',
                'guard_name' => 'web',
                'description' => 'Delete roles',
                'module' => 'role',
                'route' => 'role.delete',
            ], [
                'name' => 'assign_permission',
                'guard_name' => 'web',
                'description' => 'Assign permissions to role',
                'module' => 'role',
                'route' => 'role.assignPermissions',
            ]
        ];

        $permissions = array_merge(
            $usersPermissions,
            $storesPermissions,
            $payPermissions,
            $clockingPermissions,
            $rolePermissions,
        );

        foreach($permissions as $permissionData)
        if(Permission::where('name', $permissionData['name'])->first() == NULL) {
            Permission::create($permissionData);
        }
    }
}
