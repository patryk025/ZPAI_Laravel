<?php

namespace Database\Seeders;

use App\Models\TicketStatus;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $open = TicketStatus::create([
            'name' =>'OTWARTY'
        ]);

        $pending = TicketStatus::create([
            'name' =>'W TRAKCIE ROZWIĄZYWANIA'
        ]);

        $closed = TicketStatus::create([
            'name' =>'ZAMKNIĘTY'
        ]);

        $new = TicketStatus::create([
            'name' =>'NOWY'
        ]);

        $pendingResponse = TicketStatus::create([
            'name' =>'OCZEKUJE NA ODPOWIEDŹ'
        ]);

        $reopened = TicketStatus::create([
            'name' =>'PONOWNIE OTWARTY'
        ]);
    }
}
