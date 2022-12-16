<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TicketMessage>
 */
class TicketMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'hosting_id' => $this->faker->numberBetween(1, 50),
            'message_from' => $this->faker->numberBetween(0, 1),
            'message' => $this->faker->paragraph(6)
        ];
    }
}
