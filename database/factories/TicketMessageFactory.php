<?php

namespace Database\Factories;

use App\Models\Ticket;
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
            'ticket_id' => Ticket::select('id')
                ->orderByRaw('RAND()')
                ->first()->id,
            'message_from' => $this->faker->numberBetween(0, 1),
            'message' => $this->faker->paragraph(6)
        ];
    }
}
