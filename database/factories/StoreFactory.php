<?php

namespace Database\Factories;

use Faker\Provider\en_AU\Address;
use Faker\Provider\en_AU\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->userName(),
            'phone' => PhoneNumber::mobileNumber(),
            'emergency_phone' => PhoneNumber::mobileNumber(),
            'street' => Address::streetSuffix(),
            'suburb' => Address::state(),
            'pincode' => Address::postcode(),
        ];
    }
}
