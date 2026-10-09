<?php

namespace Database\Factories;

use App\Models\TicketRegistration;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TicketRegistration>
 */
class TicketRegistrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => '08'.fake()->numerify('##########'),
            'category' => fake()->randomElement(array_keys(TicketRegistration::CATEGORIES)),
            'quantity' => fake()->numberBetween(1, 4),
        ];
    }
}
