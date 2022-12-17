<?php

namespace App\Http\Livewire\Ticket;

use App\Models\Ticket;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\HostingType;
use Illuminate\Support\Str;

class TicketForm extends Component
{
    use Actions;
    public Ticket $ticket;
    public Bool $editmode;

    public function rules() {
        return [
            'ticket.title' => [
                'required',
                'string',
                'min:2',
                'max:100'
            ],
            'ticket.description' => [
                'required',
                'string',
                'min:2',
                'max:2000'
            ],
        ];
    }

    public function validationAttributes() {
        return [
            'title' => Str::lower(__('Tytuł')),
            'description' => Str::lower(__('Opis'))
        ];
    }

    public function mount(Ticket $ticket, Bool $editmode) {
        $this->ticket = $ticket;
        $this->editmode = $editmode;
    }

    public function render() {
        return view("livewire.ticket.ticket-form");
    }

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function save() {
        sleep(1);
        $this->validate();
        $this->ticket->save();
        $this->notification()->success(
            $title = $this->editmode
                ? "Zaktualizowano ticket"
                : "Dodano nowe zgłoszenie",
            $description = $this->editmode
                ? "Udało się zaktualizować ticket"
                : "Udało się otworzyć nowe zgłoszenie"
        );
        $this->editMode = true;
    }
}
