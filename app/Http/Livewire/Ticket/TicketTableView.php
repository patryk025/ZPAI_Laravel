<?php

namespace App\Http\Livewire\Ticket;

use App\Models\Ticket;
use WireUi\Traits\Actions;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Http\Livewire\Ticket\Actions\EditTicketAction;
use App\Http\Livewire\Ticket\Filters\SoftDeleteFilter;
use App\Http\Livewire\Ticket\Actions\SoftDeleteTicketAction;

class TicketTableView extends TableView
{
    use Actions;

    /**
     * Sets a model class to get the initial data
     */
    protected $model = Ticket::class;

    public $searchBy = [
        'status_id',
        'title',
        'description',
        'created_at',
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
            Header::title(__('Status'))->sortBy('name'),
            Header::title(__('Tytuł'))->sortBy('name'),
            Header::title(__('Opis'))->sortBy('name'),
            Header::title(__('hosting-types.attributes.created_at'))->sortBy('created_at'),
            Header::title(__('hosting-types.attributes.updated_at'))->sortBy('updated_at'),
            Header::title(__('hosting-types.attributes.deleted_at'))->sortBy('deleted_at'),
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        return [
            $model->status_id,
            $model->title,
            $model->description,
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
            new EditTicketAction('ticket.edit', 'Edytuj'),
            new SoftDeleteTicketAction()
        ];
    }

    public function softDelete(int $id) {
        $hostingType = Ticket::find($id);
        $hostingType->delete();
        $this->notification()->success(
            $title = "Usunięto",
            $description = __("Udało się skasować typ hostingu :name", [
                'name' => $hostingType->name,
            ])
        );
    }
}
