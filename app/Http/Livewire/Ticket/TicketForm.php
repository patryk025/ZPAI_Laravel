<?php

namespace App\Http\Livewire\Ticket;

use App\Models\Ticket;
use App\Models\Hosting;
use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use App\Models\TicketStatus;

class TicketForm extends Component
{
    use Actions;
    public Ticket $ticket;
    public Bool $editmode;
    public array $statuses;
    public array $hostings;

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
            'ticket.ticket_status_id' => [
                'required',
                'numeric',
            ],
            'ticket.hosting_id' => [
                'required',
                'numeric',
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
        $this->statuses = $this->getStatuses();
        $this->hostings = $this->getHostings();
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
        $this->editmode = true;
    }

    private function getStatuses(): array
    {
        $statuses = TicketStatus::select('id', 'name')->get();

        $statusesOptions = [];

        foreach($statuses as ['id' => $id, 'name' => $name]) {
            $statusesOptions[$id] = $name;
        }

        return $statusesOptions;
    }

    private function getHostings(): array
    {
        $hostings = Hosting::select('id', 'name')->get();

        $hostingsOptions = [];

        foreach($hostings as ['id' => $id, 'name' => $name]) {
            $hostingsOptions[$id] = $name;
        }

        return $hostingsOptions;
    }
}
