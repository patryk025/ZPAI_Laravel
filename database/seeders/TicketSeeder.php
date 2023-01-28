<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\TicketStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ticket::factory()->count(50)->create();

        $tickets = Ticket::all();

        $closedStatus = TicketStatus::query()->where('name','=','ZAMKNIĘTY')->get()[0]->id;

        $tickets->each(function($ticket) use ($closedStatus)
        {
            if($ticket->ticket_status_id == $closedStatus)
                $ticket->delete();
        });
    }
}
