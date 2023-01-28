<?php

namespace App\Http\Livewire\Ticket;

use App\Models\Ticket;
use WireUi\Traits\Actions;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Http\Livewire\Ticket\Actions\EditTicketAction;
use App\Http\Livewire\Ticket\Actions\OpenTicketChatAction;
use App\Http\Livewire\Ticket\Actions\RestoreTicketAction;
use App\Http\Livewire\Ticket\Filters\SoftDeleteFilter;
use App\Http\Livewire\Ticket\Actions\SoftDeleteTicketAction;
use App\Models\TicketStatus;
use Database\Seeders\TicketSeeder;

class TicketTableView extends TableView
{
    use Actions;

    /**
     * Sets a model class to get the initial data
     */
    protected $model = Ticket::class;

    public $searchBy = [
        'title',
        'description',
        'hosting.name',
        'ticket_status.name',
        'hosting.user.name',
        'updated_at',
        'deleted_at'
    ];

    public function repository(): Builder
    {
        return Ticket::query()->withTrashed();
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title(__('Tytuł'))->sortBy('title'),
            Header::title(__('Opis'))->sortBy('description'),
            Header::title(__('Hosting')),
            Header::title(__('Status')),
            Header::title(__('Nazwa użytkownika'))->sortBy('name'),
            Header::title(__('hosting-types.attributes.created_at'))->sortBy('created_at'),
            Header::title(__('hosting-types.attributes.updated_at'))->sortBy('updated_at'),
            Header::title(__('Zamknięto'))->sortBy('deleted_at'),
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        //dd($model);
        return [
            $model->title,
            $model->description,
            $model->hosting->name,
            $model->ticket_status->name,
            $model->hosting->user->name,
            $model->created_at,
            $model->updated_at,
            $model->deleted_at
        ];
    }

    protected function filters() {
        return [
            new SoftDeleteFilter
        ];
    }

    protected function actionsByRow() {
        return [
            new OpenTicketChatAction('ticket.show', 'Otwórz chat'),
            new EditTicketAction('ticket.edit', 'Edytuj'),
            new SoftDeleteTicketAction(),
            new RestoreTicketAction()
        ];
    }

    public function softDelete(int $id) {
        $ticket = Ticket::find($id);
        $ticket->delete();
        //$ticketStatus = TicketStatus::
        $this->notification()->success(
            $title = "Zamknięto",
            $description = __("Udało się zamknąć ticket :name", [
                'name' => $ticket->title,
            ])
        );
    }

    public function restore(int $id)
    {
        $ticket = Ticket::withTrashed()->find($id);
        $ticket->restore();
        $this->notification()->success(
            $title = __("Powodzenie"),
            $description = __("Przywrócono ticket :name", [
                'name' => $ticket->title
            ])
        );
    }
}
