<?php

namespace Database\Factories;

use App\Models\Hosting;
use App\Models\TicketStatus;
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
            'hosting_id' => Hosting::select('id')
                ->orderByRaw('RAND()')
                ->first()->id,
            'ticket_status_id' => TicketStatus::select('id')
                ->orderByRaw('RAND()')
                ->first(),
            'title' => $this->faker->word(),
            'description' => $this->faker->paragraph(1)
        ];
    }
}
