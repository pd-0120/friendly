<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static SuperAdmin()
 * @method static static Admin()
 * @method static static Employee()
 * @method static static Manager()
 */
final class RoleType extends Enum
{
    const SuperAdmin = "Super Admin";
    const Admin = "Admin";
    const Employee = "Employee";
    const Manager = "Manager";

    public static function getAllProperties() {
        return [
            RoleType::Admin,
            RoleType::Manager,
            RoleType::SuperAdmin,
            RoleType::Employee,

        ];
    }
}
