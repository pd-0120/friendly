<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static ThisMonth()
 * @method static static LastMonth()
 * @method static static LastThreeMonths()
 * @method static static LastSixMonths()
 * @method static static ThisYear()
 * @method static static LastYear()
 */
final class DateFilterEnum extends Enum
{
    const ThisMonth = 0;
    const LastMonth = 1;
    const LastThreeMonths = 2;
    const LastSixMonths = 3;
    const ThisYear = 4;
    const LastYear = 5;

    public static function getAllProperties()
    {
        return [
            DateFilterEnum::fromValue(DateFilterEnum::ThisMonth)->description,
            DateFilterEnum::fromValue(DateFilterEnum::LastMonth)->description,
            DateFilterEnum::fromValue(DateFilterEnum::LastThreeMonths)->description,
            DateFilterEnum::fromValue(DateFilterEnum::LastSixMonths)->description,
            DateFilterEnum::fromValue(DateFilterEnum::ThisYear)->description,
            DateFilterEnum::fromValue(DateFilterEnum::LastYear)->description,
        ];
    }
}
