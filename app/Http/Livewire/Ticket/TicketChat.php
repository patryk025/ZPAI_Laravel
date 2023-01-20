<?php

namespace App\Http\Livewire\Ticket;

use App\Models\Ticket;
use Livewire\Component;

class TicketChat extends Component
{
    public Ticket $ticket;

    public function mount(Ticket $ticket) {
        $this->ticket = $ticket;
    }

    public function render() {
        return view("livewire.ticket.ticket-chat");
    }
}
