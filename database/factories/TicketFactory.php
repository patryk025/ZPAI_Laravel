<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
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
            'status_id' => $this->faker->numberBetween(1, 5),
            'title' => $this->faker->word(),
            'description' => $this->faker->paragraph()
        ];
    }
}
